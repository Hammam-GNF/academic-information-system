# Academic Information System — Product Definition

## Overview

Academic Information System (AIS) is a scalable academic management platform designed to support educational institutions in managing their academic operations digitally.

The system aims to simplify and centralize academic activities including student management, teacher management, class management, learning activities, attendance, assessment, and academic reporting.

This project is built using Laravel 13 Enterprise Starter Kit as its foundation, adopting modern software development practices such as layered architecture, repository pattern, service layer, reusable components, role-based authorization, and automated testing.

---

# Vision

To build a flexible and maintainable academic information system that can be adapted by various educational institutions while providing a consistent and efficient digital academic workflow.

---

# Mission

The project aims to:

- Digitize academic administration processes.
- Reduce manual administrative work.
- Provide structured academic data management.
- Improve accuracy of academic records.
- Provide scalable architecture for future expansion.
- Support different educational levels and institution requirements.

---

# Target Institution

The system is designed for:

- Elementary Schools (SD)
- Junior High Schools (SMP)
- Senior High Schools (SMA)
- Vocational Schools (SMK)

The system should support different academic structures without requiring major architectural changes.

---

# Target Users

## Super Administrator

Responsibilities:

- Manage system configuration.
- Manage roles and permissions.
- Manage application settings.
- Monitor system activities.

---

## Academic Administrator

Responsibilities:

- Configure academic structure.
- Manage academic years.
- Manage classes.
- Manage subjects.
- Manage teachers.
- Manage students.

---

## Teacher

Responsibilities:

- Manage teaching activities.
- Record attendance.
- Input assessments.
- Monitor assigned classes.

---

## Homeroom Teacher

Responsibilities:

- Monitor students.
- Review attendance.
- Review academic performance.
- Prepare student reports.

---

## Principal

Responsibilities:

- Monitor academic activities.
- Review reports.
- Access school-level information.

---

# Core Scope

## Academic Master Data

The system will manage:

- Academic Year
- Semester
- School Structure
- Department / Major
- Class
- Subject
- Teacher
- Student

---

## Learning Management

The system will support:

- Teaching Assignment
- Learning Schedule
- Learning Session
- Attendance
- Assessment

---

## Academic Reporting

The system will provide:

- Student Reports
- Attendance Reports
- Grade Reports
- Academic Recap
- Export Support

Supported formats:

- PDF
- Excel
- Print
- CSV

---

# Non Scope

The following features are not part of the initial scope:

- Financial Management
- Payment Management
- Library Management
- Inventory Management
- Full Learning Management System
- Online Examination System

These features may be considered for future expansion.

---

# Core Principles

## Configurable Business Rules

Academic rules should not be hardcoded whenever possible.

Examples:

- Assessment categories.
- Attendance statuses.
- Grade calculation rules.

---

## Modular Architecture

Each system module should be independent and follow consistent architecture patterns.

Example:

```
Module

↓

Controller

↓

Service

↓

Repository

↓

Model
```

---

## Documentation First Development

Important system decisions must be documented before implementation.

Documentation includes:

- Product Definition
- Business Flow
- Use Case
- Functional Requirements
- Database Design

---

## Maintainability

The system prioritizes:

- Clean code.
- Clear responsibility separation.
- Reusable components.
- Testability.
- Long-term scalability.