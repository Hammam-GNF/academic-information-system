# Architecture

This project follows a lightweight layered architecture built on top of Laravel 13.

The goal is to keep Controllers thin, isolate business logic inside Services, and centralize database operations inside Repositories.

---

# Architecture Overview

```
Request
    │
    ▼
Route
    │
    ▼
Controller
    │
    ▼
Service
    │
    ▼
Repository
    │
    ▼
Eloquent Model
    │
    ▼
Database
```

Each layer has a single responsibility.

---

# Folder Structure

```
app
├── Exports
├── Http
│   ├── Controllers
│   ├── Middleware
│   └── Requests
├── Models
├── Policies
├── Providers
├── Repositories
│   ├── Contracts
│   └── Eloquent
├── Services
│   └── Contracts
└── View
```

---

# Layer Responsibilities

## Controllers

Controllers should stay as small as possible.

Responsibilities:

- Authorization
- Request Validation
- Call Service
- Return Response

Avoid putting business logic inside controllers.

Example:

```
Controller
    ↓
UserService
```

---

## Services

Services contain business logic.

Responsibilities:

- Business rules
- Validation beyond Form Requests
- Transaction management
- Activity Logging
- Calling repositories
- Returning responses

Services should not directly access the database.

Instead they communicate through repositories.

```
Controller
      ↓
Service
      ↓
Repository
```

---

## Repositories

Repositories encapsulate data access.

Responsibilities:

- Database queries
- Eloquent relationships
- Pagination
- Search
- Filters

Repositories should never contain business logic.

Good example:

```
UserRepository

findById()

findByEmail()

query()

queryTrashed()
```

Bad example:

```
createAdmin()

sendEmail()

assignRole()
```

Those belong inside Services.

---

## Models

Models represent database entities.

Responsibilities:

- Relationships
- Casts
- Accessors
- Mutators
- Media Collections

Avoid placing application logic inside models.

---

## Requests

Form Requests handle validation.

Responsibilities:

- Validation rules
- Authorization

Business logic belongs inside Services.

---

## Policies

Policies control permissions.

Controllers should always authorize actions before calling Services.

Example:

```
$this->authorize('update', $user);
```

---

# Dependency Injection

Services and Repositories use interfaces.

Example

```
UserController

↓

UserServiceInterface

↓

UserService

↓

UserRepositoryInterface

↓

UserRepository
```

Bindings are registered inside:

```
RepositoryServiceProvider
```

Benefits:

- Loose coupling

- Easier testing

- Replace implementations easily

---

# Repository Pattern

Repositories abstract Eloquent from the application.

Instead of:

```
Controller

↓

User::query()
```

Use:

```
Controller

↓

UserService

↓

UserRepository

↓

User Model
```

This keeps Controllers independent from database implementation.

---

# Service Pattern

Business logic belongs inside Services.

Example:

Creating a user requires:

- Create User

- Assign Role

- Activity Log

- Redirect

All of those happen inside UserService.

---

# Current Modules

Current implementation includes:

- Authentication
- Authorization
- User Management
- Activity Logs
- Media Library
- Settings
- User Dashboard
- Admin Dashboard

Each module follows the same layered architecture.

---

# Request Lifecycle

Example:

```
Browser

↓

Route

↓

UserController

↓

StoreUserRequest

↓

UserService

↓

UserRepository

↓

User Model

↓

Database

↓

Redirect Response
```

---

# Design Principles

This project follows several principles:

- Thin Controllers

- Service Layer

- Repository Layer

- Dependency Injection

- Single Responsibility Principle

- Interface-based Architecture

- Reusable Blade Components

- Separation of Concerns

---

# Future Growth

The current architecture is designed so additional modules can follow the same pattern.

Examples:

```
Product

ProductController

↓

ProductService

↓

ProductRepository

↓

Product Model
```

```
Order

OrderController

↓

OrderService

↓

OrderRepository

↓

Order Model
```

This keeps the project consistent as it grows.
