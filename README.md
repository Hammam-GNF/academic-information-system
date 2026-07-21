# Laravel 13 Starter Template

A modern Laravel 13 starter template built for scalable web applications.

This project provides a solid foundation for Laravel development with authentication, role-based authorization, reusable Blade components, repository and service layers, media management, activity logging, settings management, and a clean dashboard UI.

Designed to help developers start new Laravel projects faster while following maintainable architecture and modern development practices.

---

## ✨ Features

### Authentication

* Login
* Logout
* User Registration
* Email Verification
* Password Reset
* Password Confirmation
* Profile Management
* Avatar Upload

### Authorization

* Role-Based Access Control (RBAC)
* Admin & User Roles
* Custom Role Middleware
* Laravel Policies

### User Management

* Create User
* Edit User
* Soft Delete
* Restore User
* Force Delete
* Change Password
* Export Users to Excel

### Media Library

* Upload Files
* Delete Files
* File Validation
* Upload Loading State
* User-owned Media Protection

### Activity Logs

* User Created
* User Updated
* Password Updated
* User Deleted
* User Restored
* User Permanently Deleted

### Settings Management

* Application Settings
* Update Configuration
* Validation Support

### UI Components

* Reusable Blade Components
* Responsive Admin Layout
* Responsive User Layout
* Dashboard Components
* CRUD Components
* Button Components
* Form Components
* Modal Components
* Toast Notifications
* Badge Components

### Architecture

* Repository Pattern
* Service Layer
* Form Request Validation
* Blade Components
* Clean Project Structure

### Testing

* Pest PHP
* Feature Tests
* Authentication Tests
* Authorization Tests
* CRUD Tests
* Dashboard Tests

---

## 🛠 Tech Stack

* PHP 8.3+
* Laravel 13
* Blade
* Tailwind CSS
* Alpine.js
* Vite
* MySQL

---

## 📦 Packages

* spatie/laravel-permission
* spatie/laravel-activitylog
* spatie/laravel-medialibrary
* yajra/laravel-datatables
* maatwebsite/excel

---

## 🚀 Installation

```bash
git clone <repository-url>

cd <project-folder>

composer install

npm install

cp .env.example .env

php artisan key:generate

php artisan migrate --seed

php artisan storage:link

npm run dev

php artisan serve
```

---

## 🔐 Demo Account

### Administrator

| Email                                     | Password  |
| ----------------------------------------- | --------- |
| [admin@gmail.com](mailto:admin@gmail.com) | 123456789 |

---

## 📁 Project Structure

```
app/
├── Http/
├── Models/
├── Policies/
├── Providers/
├── Repositories/
├── Services/
└── View/

database/
resources/
routes/
tests/
```

---

## 📚 Documentation

Additional documentation is available inside the `docs/` directory.

* Installation Guide
* Project Architecture
* Blade Components
* Testing Guide
* Project Roadmap

---

## 🧪 Running Tests

```bash
php artisan test
```

or

```bash
composer test
```

---

## 📄 License

This project is open-sourced under the MIT License.
