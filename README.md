### Sistem Pos Sederhana

1. Clone Reposirory 

git clone https://github.com/Alvi19/backend-laravel.git
cd backend-laravel
composer install
cp .env.example .env

2 Buka .env lalu ubah baris berikut sesuai dengan databasemu yang ingin dipakai

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

3. Instalasi web

php artisan key:generate
php artisan migrate

4. Jalankan Website
php artisan serve