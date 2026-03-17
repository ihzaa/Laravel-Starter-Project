#!/usr/bin/env bash
set -euo pipefail

usage() {
  cat <<'USAGE'
Switch and manage Docker stack mode.

Usage:
  ./stack.sh <dev|prod> [up|down|restart|logs|ps|config] [extra args...]

Examples:
  ./stack.sh dev
  ./stack.sh dev logs app
  ./stack.sh prod
  ./stack.sh prod config
  ./stack.sh prod down
USAGE
}

MODE="${1:-}"
ACTION="${2:-up}"

if [[ -z "$MODE" || "$MODE" == "-h" || "$MODE" == "--help" ]]; then
  usage
  exit 0
fi

case "$MODE" in
  dev)
    COMPOSE_FILES=(-f compose.yaml)
    ENV_FILE=".env"
    ;;
  prod)
    COMPOSE_FILES=(-f compose.prod.yaml)
    ENV_FILE=".env.production"
    ;;
  *)
    echo "Error: mode must be 'dev' or 'prod'." >&2
    usage
    exit 1
    ;;
esac

if [[ $# -ge 2 ]]; then
  shift 2
else
  shift 1
fi

if [[ ! -f "$ENV_FILE" ]]; then
  echo "Error: $ENV_FILE not found."
  if [[ "$MODE" == "prod" ]]; then
    echo "Tip: copy .env.production.example to .env.production first."
  fi
  exit 1
fi

run_compose() {
  docker compose --env-file "$ENV_FILE" "${COMPOSE_FILES[@]}" "$@"
}

case "$ACTION" in
  up)
    run_compose up -d --build --remove-orphans "$@"
    ;;
  down)
    run_compose down "$@"
    ;;
  restart)
    run_compose restart "$@"
    ;;
  logs)
    run_compose logs -f "$@"
    ;;
  ps)
    run_compose ps "$@"
    ;;
  config)
    run_compose config "$@"
    ;;
  *)
    echo "Error: unsupported action '$ACTION'."
    usage
    exit 1
    ;;
esac
