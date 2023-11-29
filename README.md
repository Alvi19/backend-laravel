<h5 align="center">Sistem Pos Crud Sederhana</h5>

## Apa itu Sistem Informasi Akademik Sekolah?

## Install

1. **Clone Repository**

```bash
git clone https://github.com/Alvi19/backend-laravel.git
cd backend-laravel
composer install
cp .env.example .env
```

2. **Buka `.env` lalu ubah baris berikut sesuai dengan databasemu yang ingin dipakai**

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

3. **Instalasi website**

```bash
php artisan key:generate
php artisan migrate
```

4. **Jalankan website**

```bash
php artisan serve
```

## Author

- Instagram : <a href="https://www.instagram.com/alvirdh/"> alvirdh</a>
- LinkedIn : <a href="https://www.linkedin.com/in/mohalviridho/"> Moh Alvi Ridho</a>

## License

- Copyright © 2023 Moh Alvi Ridho.