#!/usr/bin/env bash
# deploy.sh — Deploy Schmoll Creative themes to GoDaddy via FTP/FTPS
#
# Usage:
#   ./deploy.sh
#
# Credentials are read from .env.deploy (gitignored). Copy .env.deploy.example
# if starting fresh. Requires lftp (sudo apt install lftp / brew install lftp).

set -euo pipefail

REPO_ROOT="$(cd "$(dirname "$0")" && pwd)"
ENV_FILE="${REPO_ROOT}/.env.deploy"

# ── Load credentials ──────────────────────────────────────────────────────────
if [[ ! -f "${ENV_FILE}" ]]; then
    echo "ERROR: ${ENV_FILE} not found."
    echo "Create it with:"
    echo "  FTP_HOST=ftp.schmollcreative.com"
    echo "  FTP_USER=your_ftp_user"
    echo "  FTP_PASS=your_ftp_password"
    echo "  FTP_PORT=21"
    echo "  DEPLOY_PATH=public_html/claudestage"
    exit 1
fi

# shellcheck disable=SC1090
source "${ENV_FILE}"

FTP_HOST="${FTP_HOST:?FTP_HOST not set}"
FTP_USER="${FTP_USER:?FTP_USER not set}"
FTP_PASS="${FTP_PASS:?FTP_PASS not set}"
FTP_PORT="${FTP_PORT:-21}"
DEPLOY_PATH="${DEPLOY_PATH:-public_html/claudestage}"

THEMES_DEST="${DEPLOY_PATH}/wp-content/themes"
THEMES_SRC_PARENT="${REPO_ROOT}/schmoll-creative"
THEMES_SRC_CHILD="${REPO_ROOT}/schmoll-creative-child"

echo "==> Deploying Schmoll Creative themes to FTP"
echo "    Host : ${FTP_HOST}:${FTP_PORT}"
echo "    Path : ${THEMES_DEST}"
echo ""

# ── lftp mirror helper ────────────────────────────────────────────────────────
ftp_mirror() {
    local local_dir="$1"
    local remote_dir="$2"

    lftp -u "${FTP_USER},${FTP_PASS}" \
         -p "${FTP_PORT}" \
         "ftps://${FTP_HOST}" <<LFTP_SCRIPT
set ssl:verify-certificate no
set ftp:ssl-force true
set ftp:ssl-protect-data true
set net:timeout 30
set net:max-retries 3
set net:reconnect-interval-base 5
mirror --reverse --delete --verbose \
       --exclude='.DS_Store' \
       --exclude='.git/' \
       --exclude='*.zip' \
       "${local_dir}/" \
       "${remote_dir}/"
bye
LFTP_SCRIPT
}

echo "--> Syncing parent theme (schmoll-creative)..."
ftp_mirror "${THEMES_SRC_PARENT}" "${THEMES_DEST}/schmoll-creative"

echo ""
echo "--> Syncing child theme (schmoll-creative-child)..."
ftp_mirror "${THEMES_SRC_CHILD}" "${THEMES_DEST}/schmoll-creative-child"

echo ""
echo "==> Done."
echo "    Staging URL : https://schmollcreative.com/claudestage/"
echo ""
echo "    Remember to flush WordPress permalinks if needed:"
echo "    WP Admin > Settings > Permalinks > Save Changes"
