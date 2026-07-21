# Installation Guide

This guide explains how to set up the Laravel 13 Starter Template for local development.

---

# Requirements

Before installing the project, ensure your development environment meets the following requirements.

| Software | Version |
|----------|---------|
| PHP | 8.3 or higher |
| Composer | Latest |
| Node.js | 22+ |
| npm | Latest |
| Database | SQLite or MySQL |

---

# Clone Repository

Clone the project into your local machine.

```bash
git clone <repository-url>

cd <project-folder>
```

---

# Install Dependencies

Install PHP dependencies.

```bash
composer install
```

Install frontend dependencies.

```bash
npm install
```

---

# Environment Configuration

Create the environment file.

```bash
cp .env.example .env
```

Generate the application key.

```bash
php artisan key:generate
```

The default environment uses:

- Local environment
- SQLite database
- Database session driver
- Database cache driver
- Database queue driver
- Local filesystem
- Asia/Jakarta timezone

If you prefer MySQL, update the following variables inside `.env`.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

---

# Database Setup

Run migrations together with the default seeders.

```bash
php artisan migrate --seed
```

The following seeders will be executed automatically.

- RolePermissionSeeder
- AdminSeeder
- SettingSeeder

Additional demo users are also generated for development purposes.

---

# Storage Link

Create the public storage symlink.

```bash
php artisan storage:link
```

This step is required for Media Library uploads.

---

# Build Frontend Assets

Start the Vite development server.

```bash
npm run dev
```

For production assets.

```bash
npm run build
```

---

# Start Development Server

Run Laravel.

```bash
php artisan serve
```

The application will be available at

```
http://127.0.0.1:8000
```

---

# Default Administrator Account

After running the seeders, the following administrator account is available.

| Email | Password |
|-------|----------|
| admin@gmail.com | 123456789 |

---

# Available Roles

The starter template includes two default roles.

| Role | Description |
|------|-------------|
| Admin | Full access to the administration panel |
| User | Standard authenticated user |

---

# Default Application Flow

Guest users

```
/
↓
Welcome Page
```

Authenticated Admin

```
/
↓
Admin Dashboard
```

Authenticated User

```
/
↓
User Dashboard
```

---

# Useful Commands

Run development server.

```bash
php artisan serve
```

Run Vite.

```bash
npm run dev
```

Run tests.

```bash
php artisan test
```

or

```bash
composer test
```

Clear application cache.

```bash
php artisan optimize:clear
```

Rebuild autoload files.

```bash
composer dump-autoload
```

---

# Troubleshooting

## Storage images are not accessible

Run

```bash
php artisan storage:link
```

---

## Changes are not reflected

Clear Laravel caches.

```bash
php artisan optimize:clear
```

Restart Vite.

```bash
npm run dev
```

---

## Migration fails

Ensure your database exists and the connection inside `.env` is configured correctly.

---

## Permission errors

Ensure the following directories are writable.

```
storage/
bootstrap/cache/
```

---

# Next Step

After installation is complete, continue reading the documentation.

- Architecture Guide
- Blade Components
- Testing Guide
- Project Roadmap
