#!/usr/bin/env bash

START_DIR="$(pwd)"

if [ "$#" -ne 1 ]; then
  echo "Usage: $0 <target_directory>"
  exit 1
fi

TARGET_DIR="$1"

cd "$TARGET_DIR" || exit 1;

docker compose exec lv composer install --optimize-autoloader --no-dev

docker compose exec lv php artisan optimize

cd "$START_DIR" || exit 1;
