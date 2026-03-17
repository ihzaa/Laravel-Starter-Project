#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")" && pwd)"
cd "$SCRIPT_DIR"

SERVICE="${APP_SERVICE:-app}"

usage() {
  cat <<'USAGE'
Run Laravel Artisan command inside Docker container.

Usage:
  ./artisan.sh <artisan-command> [arguments...]

Examples:
  ./artisan.sh migrate
  ./artisan.sh optimize:clear
  ./artisan.sh make:controller UserController
USAGE
}

if [[ "${1:-}" == "-h" || "${1:-}" == "--help" || $# -eq 0 ]]; then
  usage
  exit 0
fi

if ! command -v docker >/dev/null 2>&1; then
  echo "Error: docker is not installed or not in PATH." >&2
  exit 1
fi

if ! docker compose version >/dev/null 2>&1; then
  echo "Error: docker compose is not available." >&2
  exit 1
fi

if ! docker compose ps --status running --services 2>/dev/null | grep -qx "$SERVICE"; then
  echo "Container '$SERVICE' is not running. Starting it..."
  docker compose up -d "$SERVICE"
fi

if [[ -t 0 && -t 1 ]]; then
  docker compose exec "$SERVICE" php artisan "$@"
else
  docker compose exec -T "$SERVICE" php artisan "$@"
fi
