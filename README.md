<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## step 1
> 還原 composer.json
```powershell
composer install
```
## step 2
> 還原 packages.json
```powershell
npm install
```
## step 3
> 複製 .env.example 為 .env
```powershell
cp .env.example .env
```
## step 4
> 修改 .env 檔內的設定
```powershell
APP_NAME=醫指派

LOG_CHANNEL=daily
LOG_LEVEL=debug

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=ambulance
DB_USERNAME=postgres
DB_PASSWORD=robby560420
```
## step 5
> 取得 APP_KEY
```powershell
php artisan key:generate
```
## step 6
> 建立資料庫
```powershell
php artisan migrate
```
## step 7
> 同步儲存資料夾
```powershell
php artisan storage:link
```