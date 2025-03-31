#!/usr/bin/env bash

START_DIR=$(pwd)

USER_ID=$(id -u)
GROUP_ID=$(id -g)
TARGET_DIR="./msvc"

while getopts u:g:d: flag; do
    case "${flag}" in
    u*) USER_ID=${OPTARG} ;;
    g*) GROUP_ID=${OPTARG} ;;
    d*) TARGET_DIR=${OPTARG} ;;
    esac
done

if [ ! -d "$TARGET_DIR" ]; then
  echo "Target dir not found: $TARGET_DIR"
  exit 1
fi
cd "$TARGET_DIR" || exit 1

mkdir -p "./volumes/pgsql"
mkdir -p "./volumes/mysql"
mkdir -p "./volumes/mariadb"
mkdir -p "./volumes/redis"
mkdir -p "./volumes/selenium/chrome-data"

cp -a "./.env.example" "./env.dev"
cp -a "./.env.example" "./env.prod"

chown -R "$USER_ID":"$GROUP_ID" "$TARGET_DIR"
chmod -R ug+rwx "$TARGET_DIR"

if [[ "$OSTYPE" == "msys"* || "$OSTYPE" == "cygwin"* ]]; then
    DOCKER_PWD=$(pwd -W)
    VOLUME_MOUNT="/$DOCKER_PWD:/var/www/html"
    WORKDIR="//var/www/html"
else
    DOCKER_PWD=$(pwd)
    VOLUME_MOUNT="$DOCKER_PWD:/var/www/html"
    WORKDIR="/var/www/html"
fi

docker run --rm \
    -v "$VOLUME_MOUNT" \
    -w "$WORKDIR" \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs

cd "$START_DIR" || exit 1;
