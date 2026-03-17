#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")" && pwd)"
cd "$SCRIPT_DIR"

SERVICE="${APP_SERVICE:-app}"

usage() {
  cat <<'USAGE'
Run any command inside Docker container.

Usage:
  ./container.sh [--service <service-name>] [command [args...]]

Defaults:
  service: app (or APP_SERVICE env)
  command: bash

Examples:
  ./container.sh
  ./container.sh php -v
  ./container.sh --service db psql -U laravel -d laravel_starter_project
USAGE
}

if [[ "${1:-}" == "-h" || "${1:-}" == "--help" ]]; then
  usage
  exit 0
fi

if [[ "${1:-}" == "--service" ]]; then
  if [[ $# -lt 2 ]]; then
    echo "Error: missing value for --service." >&2
    exit 1
  fi
  SERVICE="$2"
  shift 2
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

if [[ $# -eq 0 ]]; then
  set -- bash
fi

if [[ -t 0 && -t 1 ]]; then
  docker compose exec "$SERVICE" "$@"
else
  docker compose exec -T "$SERVICE" "$@"
fi
