#!/bin/bash
# ============================================================
# KSC DEPLOY — PASSWORD SETUP
# Run this ONCE to store your FTP password in macOS Keychain.
# Usage: bash "/Users/kevinschmoll/Desktop/schmollcreative/static-build/Schmol Creative/setup-password.sh"
# ============================================================

FTP_HOST="198.12.218.75"
FTP_USER="kevinschmoll79"

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "  KSC DEPLOY — Keychain Password Setup"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "  This saves your FTP password to macOS Keychain."
echo "  It will be stored encrypted — not in any file."
echo ""

read -s -p "Enter FTP password: " FTP_PASS
echo ""

# Delete existing entry if present
security delete-generic-password \
  -s "ksc-deploy-ftp" \
  -a "$FTP_USER" > /dev/null 2>&1

# Store in keychain
security add-generic-password \
  -s "ksc-deploy-ftp" \
  -a "$FTP_USER" \
  -w "$FTP_PASS" \
  -T "" \
  -l "KSC Deploy FTP ($FTP_HOST)"

if [ $? -eq 0 ]; then
  echo ""
  echo "  ✓ Password saved to macOS Keychain."
  echo "  You won't need to enter it again when running deploy.sh"
  echo ""
else
  echo ""
  echo "  ✗ Failed to save to Keychain."
  echo ""
fi
