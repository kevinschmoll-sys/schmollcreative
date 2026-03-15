#!/usr/bin/env bash
# deploy.sh — Sync Schmoll Creative themes to public_html/claudestage staging
#
# Usage:
#   ./deploy.sh [user@host]
#
# If no host argument is given, the script deploys to the local path
# ~/public_html/claudestage (useful when running on the hosting server itself).
#
# Environment variables (override defaults):
#   DEPLOY_HOST   SSH user@host  (e.g. kevinschmoll@kevinschmoll.com)
#   DEPLOY_PATH   Remote/local base path (default: ~/public_html/claudestage)
#   SSH_PORT      SSH port (default: 22)

set -euo pipefail

REPO_ROOT="$(cd "$(dirname "$0")" && pwd)"
THEMES_SRC_PARENT="${REPO_ROOT}/schmoll-creative"
THEMES_SRC_CHILD="${REPO_ROOT}/schmoll-creative-child"

DEPLOY_HOST="${DEPLOY_HOST:-${1:-}}"
DEPLOY_PATH="${DEPLOY_PATH:-public_html/claudestage}"
SSH_PORT="${SSH_PORT:-22}"

THEMES_DEST="${DEPLOY_PATH}/wp-content/themes"

# Rsync options: archive, compress, delete removed files, verbose summary
RSYNC_OPTS=(-avz --delete --exclude='.DS_Store' --exclude='*.zip' --exclude='.git')

echo "==> Deploying Schmoll Creative to: ${DEPLOY_HOST:-local}:${DEPLOY_PATH}"
echo "    Themes destination: ${THEMES_DEST}"
echo ""

if [[ -n "${DEPLOY_HOST}" ]]; then
    # ── Remote deploy via rsync over SSH ──────────────────────────────────
    SSH_OPTS=(-e "ssh -p ${SSH_PORT} -o StrictHostKeyChecking=accept-new")

    echo "--> Syncing parent theme (schmoll-creative)..."
    rsync "${RSYNC_OPTS[@]}" "${SSH_OPTS[@]}" \
        "${THEMES_SRC_PARENT}/" \
        "${DEPLOY_HOST}:${THEMES_DEST}/schmoll-creative/"

    echo "--> Syncing child theme (schmoll-creative-child)..."
    rsync "${RSYNC_OPTS[@]}" "${SSH_OPTS[@]}" \
        "${THEMES_SRC_CHILD}/" \
        "${DEPLOY_HOST}:${THEMES_DEST}/schmoll-creative-child/"

    echo ""
    echo "==> Done. Verify at https://${DEPLOY_HOST#*@}/${DEPLOY_PATH#public_html/}"
else
    # ── Local deploy (running directly on the server) ─────────────────────
    DEST_PARENT="${HOME}/${THEMES_DEST}/schmoll-creative"
    DEST_CHILD="${HOME}/${THEMES_DEST}/schmoll-creative-child"

    mkdir -p "${DEST_PARENT}" "${DEST_CHILD}"

    echo "--> Syncing parent theme (schmoll-creative)..."
    rsync "${RSYNC_OPTS[@]}" \
        "${THEMES_SRC_PARENT}/" \
        "${DEST_PARENT}/"

    echo "--> Syncing child theme (schmoll-creative-child)..."
    rsync "${RSYNC_OPTS[@]}" \
        "${THEMES_SRC_CHILD}/" \
        "${DEST_CHILD}/"

    echo ""
    echo "==> Done. Themes deployed to:"
    echo "    ${DEST_PARENT}"
    echo "    ${DEST_CHILD}"
    echo ""
    echo "    Remember to flush WordPress permalinks:"
    echo "    WP Admin > Settings > Permalinks > Save Changes"
fi
