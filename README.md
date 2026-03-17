# Laravel Starter Project

Starter project Laravel 12 dengan runtime FrankenPHP + PostgreSQL, disiapkan untuk 2 mode:

- `dev`: nyaman untuk ngoding harian.
- `prod`: configuration production-like untuk validasi/deploy.

## Stack

- Laravel `12.x`
- PHP `8.4` (FrankenPHP)
- PostgreSQL `16`
- Docker Compose v2

## Struktur File Penting

- `compose.yaml`: mode development
- `compose.prod.yaml`: mode production-like
- `stack.sh`: switch & manage stack (`dev` / `prod`)
- `artisan.sh`: jalankan Artisan di container app
- `container.sh`: jalankan command umum di service container
- `docker/frankenphp/Dockerfile`: image dev + production
- `docker/frankenphp/Caddyfile`: web server config
- `.env.example`: template env development
- `.env.production.example`: template env production

## Prasyarat

- Docker + Docker Compose terpasang
- Port yang dipakai tidak bentrok:
  - App: `APP_PORT` (default `8080`)
  - DB dev: `FORWARD_DB_PORT` (default `5432`)

## Setup Development (Standar)

1. Siapkan env dev:

```bash
cp .env.example .env
```

2. Jalankan stack dev:

```bash
./stack.sh dev
```

3. Generate app key:

```bash
./artisan.sh key:generate
```

4. Migrasi + seed:

```bash
./artisan.sh migrate --seed
```

5. Akses aplikasi:

- `http://localhost:8080`

## Workflow Harian

- Start/update dev stack:

```bash
./stack.sh dev
```

- Cek status:

```bash
./stack.sh dev ps
```

- Lihat logs:

```bash
./stack.sh dev logs app
./stack.sh dev logs db
```

- Stop stack:

```bash
./stack.sh dev down
```

## Helper Script

### Artisan wrapper

```bash
./artisan.sh migrate
./artisan.sh optimize:clear
./artisan.sh make:controller UserController
```

### General container wrapper

```bash
./container.sh php -v
./container.sh
./container.sh --service db pg_isready -U laravel -d laravel_starter_project
```

## Mode Production-like

Mode ini dipakai untuk validasi seperti production (image immutable, tanpa bind mount source code).

1. Siapkan env production:

```bash
cp .env.production.example .env.production
```

2. Isi minimal variabel penting di `.env.production`:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL`
- `APP_KEY`
- `JWT_SECRET`
- `DB_*`
- `DB_PORT` boleh diubah, karena service `app` dan `db` sama-sama mengikuti nilai ini.

3. Jalankan stack prod:

```bash
./stack.sh prod
```

4. Cek final compose config:

```bash
./stack.sh prod config
```

5. Stop prod stack:

```bash
./stack.sh prod down
```

## Checklist Sebelum Deploy

- `.env.production` terisi benar (tidak pakai value contoh)
- `APP_DEBUG=false`
- `APP_KEY` sudah valid
- `JWT_SECRET` sudah diset
- DB credential aman dan bukan default
- Migration sudah dites di environment staging
- Endpoint aplikasi merespons normal

## Catatan Standar yang Dipakai

- `dev` menggunakan bind mount source code agar hot-edit nyaman.
- `prod` tidak bind mount source code (lebih konsisten dan aman).
- Service memakai restart policy `unless-stopped`.
- DB port hanya diexpose di `dev`, tidak di `prod`.
- `.env.production` di-ignore dari git.

## Troubleshooting Cepat

- Permission issue pada file hasil generate:
  - pastikan `UID`/`GID` di `.env` sesuai user host (default `1000:1000`).

- Compose prod gagal karena env belum ada:

```bash
cp .env.production.example .env.production
```

- Reset stack bersih:

```bash
./stack.sh dev down
./stack.sh dev
```
