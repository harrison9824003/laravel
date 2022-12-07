<h2>環境</h2>

<ul>
    <li>PHP 8</li>
    <li>vue 2</li>
</ul>

<h2>初始流程</h2>

1. docker compose yml: https://github.com/harrison9824003/docker/tree/master/server/laravel

    <ul>
        <li>server 環境包含 nginx + mysql + php + redis, php image 有另外用 Dockerfile 產生(檔案連結:https://github.com/harrison9824003/docker/tree/master/php/fpm/swoole)</li>
        <li>.env 檔案環境變數, 目前只有網站資料夾 WEBSITE</li>
        <li>server 資料夾 laravel 放置與 laravel 同層</li>
    </ul>

2. 啟動 docker

   `docker compose up -d`

3. 建立資料庫 laravel

   預設使用 root 帳密登入 mysql, 手動建立 laravel 資料庫

4. 複製 .env.example 成 .env

5. 系統環境下執行命令 composer 安裝套件

   `composer install`

6. 進入 docker php 命令行執行 migrate 建立資料表和指令 init:website 產生預設資料(若要自行新增資料可不執行指令)

   `php artisan migrate`

   `php artisan init:website`

 5. 前台畫面建立

    `npm run dev`

6. 用瀏覽器輸入網址 http://127.0.0.1 看前台網站
7. 後臺網址  http://127.0.0.1/adm , 需設定 .env email server 
