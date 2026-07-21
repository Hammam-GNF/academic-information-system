# Testing Guide

This project uses **Pest PHP** as the primary testing framework together with Laravel's testing utilities.

---

# Testing Stack

- Pest PHP
- PHPUnit
- Laravel Testing Helpers
- RefreshDatabase
- SQLite In-Memory Database

---

# Testing Environment

Tests run using a dedicated testing environment configured inside `phpunit.xml`.

Default testing configuration:

| Setting | Value |
|---------|-------|
| APP_ENV | testing |
| Database | SQLite (:memory:) |
| Queue | sync |
| Cache | array |
| Session | array |
| Mail | array |

Each test starts with a fresh database using:

```php
RefreshDatabase
```

Role and permission data are automatically seeded before each Feature test.

---

# Project Structure

```
tests/
├── Feature/
│   ├── Admin/
│   ├── Auth/
│   ├── User/
│   ├── ProfileTest.php
│   ├── SmokeTest.php
│   └── ExampleTest.php
│
├── Unit/
│   └── ExampleTest.php
│
├── Pest.php
└── TestCase.php
```

---

# Available Feature Tests

## Authentication

- Login
- Registration
- Password Reset
- Password Confirmation
- Password Update
- Email Verification

---

## Profile

- Update Profile
- Update Avatar
- Delete Account

---

## Admin

- Dashboard
- User CRUD
- Authorization
- Settings
- Media Library
- Activity Logs

---

## User

- User Dashboard

---

## Smoke Test

Basic application availability test.

---

# Running All Tests

```bash
php artisan test
```

or

```bash
composer test
```

---

# Running Specific Tests

Run a single test file:

```bash
php artisan test tests/Feature/Admin/UserCrudTest.php
```

Run a specific directory:

```bash
php artisan test tests/Feature/Admin
```

Run Unit tests only:

```bash
php artisan test tests/Unit
```

Run Feature tests only:

```bash
php artisan test tests/Feature
```

---

# Running Tests with Filter

Execute a specific test by its name.

```bash
php artisan test --filter=UserCrudTest
```

Example:

```bash
php artisan test --filter=DashboardTest
```

---

# Test Database

Feature tests use an in-memory SQLite database.

No manual database setup is required.

Database migrations are executed automatically before each test suite.

---

# Pest Configuration

Global testing configuration is located in:

```
tests/Pest.php
```

This file configures:

- Base TestCase
- RefreshDatabase
- RolePermissionSeeder
- Global expectations
- Shared helpers

---

# Writing New Tests

Create a Feature test:

```bash
php artisan make:test Admin/UserTest --pest
```

Create a Unit test:

```bash
php artisan make:test Services/UserServiceTest --unit --pest
```

---

# Best Practices

- Write Feature tests for application behavior.
- Write Unit tests for isolated business logic.
- Keep tests independent.
- Avoid relying on test execution order.
- Use descriptive test names.
- Seed only the required data.
- Prefer factories over manual model creation.
- Keep assertions focused on one behavior per test.

---

# Continuous Testing

While developing, tests can be executed repeatedly to verify that new changes do not introduce regressions.

It is recommended to run the complete test suite before every commit or release.

---

# Troubleshooting

### Tests fail because of stale cache

```bash
php artisan optimize:clear
```

---

### Composer autoload issue

```bash
composer dump-autoload
```

---

### Database migration issue

```bash
php artisan migrate:fresh
```

---

# Summary

The project includes automated tests covering:

- Authentication
- Authorization
- User Management
- Profile Management
- Admin Dashboard
- User Dashboard
- Settings
- Media Library
- Activity Logs

Using Pest PHP together with Laravel's testing tools helps ensure application reliability while keeping tests simple and maintainable.
