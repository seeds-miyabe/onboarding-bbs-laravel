#!/bin/bash
set -e

if [ ! -d "vendor" ]; then
    echo "=================================================="
    echo " vendor ディレクトリが見つかりません。"
    echo " 初回セットアップ: composer install を実行します..."
    echo "=================================================="
    composer install --no-interaction --prefer-dist
fi

exec "$@"
