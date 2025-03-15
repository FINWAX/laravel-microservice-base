#!/usr/bin/env bash

START_DIR="$(pwd)"

if [ "$#" -ne 1 ]; then
  echo "Usage: $0 <target_directory>"
  exit 1
fi

TARGET_DIR="$1"

cd "$TARGET_DIR" || exit 1;

docker compose exec lv composer install

docker compose exec lv php artisan optimize:clear
docker compose exec lv php artisan config:clear
docker compose exec lv php artisan event:clear
docker compose exec lv php artisan route:clear
docker compose exec lv php artisan view:clear
docker compose exec lv php artisan cache:clear

cd "$START_DIR" || exit 1;
