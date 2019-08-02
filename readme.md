# Bone
> Bone adalah template laravel yang sering saya gunakan untuk membuat project di [kadangkoding](https://kadangkoding.com)

## Inside this template?
- Laravel-debugbar
- Laravel-backup
- [Stisla admin template](https://getstisla.com/)

## Install
Saya menggunakan `Laravel Valet` untuk proses development

Download dari branch master

```
git clone https://github.com/jokosusilo/bone.git
```

Install composer dependencies

```
composer install
```

Copy .env.example to .env

```
cp .env.example .env
```

Generate application key

```
php artisan key:generate
```

Buat database dan setting `.env` kemudian jalankan db migration

```
php artisan migrate --seed
```

## Note
Untuk asset sementara belum menggunakan SAAS atau preprocessor lainnya.