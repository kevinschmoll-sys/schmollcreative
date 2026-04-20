#!/bin/bash
# ============================================================
# KSC DEPLOY — incremental, curl FTP
# Host/path match Cyberduck bookmark exactly
# Usage: push-site
# ============================================================

FTP_HOST="schmollcreative.com"
FTP_USER="kevinschmoll79"
FTP_PORT="21"
REMOTE_DIR="public_html/punksite"
LOCAL_DIR="/Users/kevinschmoll/Desktop/schmollcreative/static-build/Schmol Creative"
CACHE_FILE="$LOCAL_DIR/.deploy-cache"

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "  KSC DEPLOY → schmollcreative.com/punksite/"
echo "  Mode: incremental (changed files only)"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

FTP_PASS=$(security find-generic-password -s "ksc-deploy-ftp" -a "$FTP_USER" -w 2>/dev/null)
if [ -z "$FTP_PASS" ]; then
  echo "  ✗ No password in Keychain. Run setup-password.sh first."
  exit 1
fi
echo "  ✓ Password loaded"
echo ""

# Test connection
echo "Testing connection..."
curl --silent --connect-timeout 10 \
  "ftp://$FTP_HOST:$FTP_PORT/$REMOTE_DIR/" \
  --user "$FTP_USER:$FTP_PASS" --list-only > /dev/null 2>&1
if [ $? -ne 0 ]; then
  echo "✗ Cannot connect to $FTP_HOST"
  exit 1
fi
echo "✓ Connected"
echo ""

# ── Cache lookup ──────────────────────────────────────────────
get_cached_checksum() {
  local rel="$1"
  [ -f "$CACHE_FILE" ] && grep -F "|${rel}$" "$CACHE_FILE" 2>/dev/null | cut -d'|' -f1
}

# ── URL-encode ────────────────────────────────────────────────
urlencode() {
  local s="$1" out="" i c
  for (( i=0; i<${#s}; i++ )); do
    c="${s:$i:1}"
    case "$c" in
      [a-zA-Z0-9./_-]) out+="$c" ;;
      ' ') out+="%20" ;;
      *) out+=$(printf '%%%02X' "'$c") ;;
    esac
  done
  echo "$out"
}

# ── Upload function ───────────────────────────────────────────
upload_file() {
  local local_path="$1" rel="$2"
  local encoded_rel; encoded_rel=$(urlencode "$rel")
  curl --silent --show-error \
    --ftp-create-dirs \
    -T "$local_path" \
    "ftp://$FTP_HOST:$FTP_PORT/$REMOTE_DIR/$encoded_rel" \
    --user "$FTP_USER:$FTP_PASS"
}

# ── Scan + upload changed files ───────────────────────────────
echo "Scanning for changes..."
echo ""

UPLOADED=0; SKIPPED=0; FAILED=0; NEW_CACHE=""

while IFS= read -r -d '' file; do
  rel="${file#$LOCAL_DIR/}"
  checksum=$(md5 -q "$file" 2>/dev/null || md5sum "$file" 2>/dev/null | cut -d' ' -f1)
  cached=$(get_cached_checksum "$rel")

  if [ "$cached" = "$checksum" ]; then
    SKIPPED=$((SKIPPED+1))
    NEW_CACHE+="$checksum|$rel"$'\n'
    continue
  fi

  upload_file "$file" "$rel"
  if [ $? -eq 0 ]; then
    echo "  ✓  $rel"
    NEW_CACHE+="$checksum|$rel"$'\n'
    UPLOADED=$((UPLOADED+1))
  else
    echo "  ✗  FAILED: $rel"
    [ -n "$cached" ] && NEW_CACHE+="$cached|$rel"$'\n'
    FAILED=$((FAILED+1))
  fi

done < <(find "$LOCAL_DIR" -type f \
  ! -path "*/.git/*" \
  ! -name ".DS_Store" \
  ! -name ".gitignore" \
  ! -name ".gitattributes" \
  ! -name ".deploy-cache" \
  ! -name "deploy.sh" \
  ! -name "README.md" \
  -print0)

# .htaccess
if [ -f "$LOCAL_DIR/.htaccess" ]; then
  rel=".htaccess"
  checksum=$(md5 -q "$LOCAL_DIR/.htaccess" 2>/dev/null || md5sum "$LOCAL_DIR/.htaccess" 2>/dev/null | cut -d' ' -f1)
  cached=$(get_cached_checksum "$rel")
  if [ "$cached" != "$checksum" ]; then
    upload_file "$LOCAL_DIR/.htaccess" "$rel"
    [ $? -eq 0 ] && echo "  ✓  .htaccess" && NEW_CACHE+="$checksum|$rel"$'\n' && UPLOADED=$((UPLOADED+1)) \
      || { FAILED=$((FAILED+1)); [ -n "$cached" ] && NEW_CACHE+="$cached|$rel"$'\n'; }
  else
    SKIPPED=$((SKIPPED+1)); NEW_CACHE+="$checksum|$rel"$'\n'
  fi
fi

printf '%s' "$NEW_CACHE" > "$CACHE_FILE"

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
printf "  Uploaded: %d  |  Skipped: %d  |  Failed: %d\n" $UPLOADED $SKIPPED $FAILED
echo "  https://schmollcreative.com/punksite/"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
