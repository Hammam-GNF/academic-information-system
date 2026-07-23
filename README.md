# Academic Information System

A modern Academic Information System built with Laravel 13.

This project is designed as a scalable school management platform that supports academic operations such as student management, teacher management, class management, learning activities, attendance, assessment, reporting, and future academic integrations.

Built on top of a Laravel 13 Enterprise Starter Kit foundation, this project follows modern Laravel development practices including layered architecture, repository pattern, service layer, reusable Blade components, role-based authorization, testing, and maintainable project structure.

The goal of this project is to provide a flexible academic platform that can be adapted for different educational institutions such as elementary schools, junior high schools, senior high schools, and vocational schools.

---

# ✨ Features

## Authentication

* Login
* Logout
* User Registration
* Email Verification
* Password Reset
* Password Confirmation
* Profile Management
* Avatar Upload

---

## Authorization

* Role-Based Access Control (RBAC)
* Permission Management
* Laravel Policies
* Custom Role Middleware

---

## Academic Management

Planned academic modules include:

* Academic Year Management
* Semester Management
* School Structure Management
* Teacher Management
* Student Management
* Class Management
* Subject Management
* Learning Assignment Management

---

## Learning Process

The learning process is built around the core concept of teaching assignments.

Future modules include:

* Teaching Schedule
* Learning Sessions
* Attendance Management
* Assessment Management
* Grade Calculation
* Report Generation

---

## Reporting

Planned reporting features:

* Academic Reports
* Student Reports
* Attendance Reports
* Grade Reports
* PDF Export
* Excel Export
* Print Support
* CSV Export

---

## UI Components

The project uses a reusable design system foundation.

Includes:

* Blade Components
* Responsive Admin Layout
* Responsive User Layout
* Dashboard Components
* CRUD Components
* Form Components
* Button Components
* Modal Components
* Toast Notifications
* Badge Components

---

# 🏗 Architecture

This project follows a layered architecture approach.

Architecture principles:

* Thin Controllers
* Service Layer
* Repository Layer
* Dependency Injection
* Interface-based Programming
* Separation of Concerns
* Reusable Components

Main flow:

```
Controller

↓

Service

↓

Repository

↓

Model

↓

Database
```

---

# 🛠 Tech Stack

* PHP 8.3+
* Laravel 13
* Blade
* Tailwind CSS
* Alpine.js
* Vite
* MySQL

---

# 📦 Packages

Core packages inherited from the Laravel Starter Kit:

* spatie/laravel-permission
* spatie/laravel-activitylog
* spatie/laravel-medialibrary
* yajra/laravel-datatables
* maatwebsite/excel

---

# 🚀 Installation

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

# 👥 Target Users

The system is designed for educational institutions with users such as:

## Super Administrator

Responsible for:

* System configuration
* Role management
* Permission management

---

## Academic Administrator

Responsible for:

* Academic setup
* Teacher management
* Student management
* Class management

---

## Teacher

Responsible for:

* Learning activities
* Attendance
* Assessment

---

## Homeroom Teacher

Responsible for:

* Student monitoring
* Academic review
* Report preparation

---

## Principal

Responsible for:

* Monitoring
* Academic reports
* School statistics

---

# 📚 Documentation

Detailed documentation is available inside the `docs` directory.

Current documentation:

* Installation Guide
* Architecture Guide
* Blade Components Guide
* Testing Guide
* Project Roadmap

Academic System documentation:

* Product Definition
* Business Flow
* Use Case
* Functional Requirements
* Database Design

---

# 🧪 Running Tests

```bash
php artisan test
```

or

```bash
composer test
```

---

# 📄 License

This project is open-sourced under the MIT License.
