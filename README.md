# アプリケーション名

    Product Manager

## 環境構築

    git clone git@github.com:WDRNT/test-mogitate.git/
    cp .env.example .env
    docker-compose up -d --build
    docker-compose exec php bash
    composer install
    php artisan key:generate
    php artisan migrate --seed
    php artisan storage:link

## 使用技術（実行環境）

    Laravel: 8.x
    php:8.1
    nginx:1.21.1

## ER 図

## URL

    開発環境: http://localhost/
