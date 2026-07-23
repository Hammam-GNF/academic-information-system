# Academic Information System Use Case

This document defines the use cases of the Academic Information System.

The purpose of this document is to describe system interactions between actors and academic processes before implementation begins.

---

# 1. System Actors

The system consists of several actors with different responsibilities.

---

# Administrator

Administrator manages the overall academic system.

Responsibilities:

- Manage users
- Manage roles and permissions
- Manage academic structure
- Manage teachers
- Manage students
- Manage system configuration
- Monitor academic activities

---

# Teacher

Teacher manages learning activities.

Responsibilities:

- View teaching schedule
- Manage learning sessions
- Record attendance
- Manage assessments
- View student academic progress

---

# Student

Student accesses personal academic information.

Responsibilities:

- View profile
- View class information
- View schedule
- View attendance
- View assessment results
- View academic reports

---

# 2. Use Case Overview

The system is divided into several functional domains.
Academic Information System
    │

    ├── Authentication & Authorization

    ├── User Management

    ├── Academic Structure

    ├── Student Management

    ├── Teacher Management

    ├── Learning Process

    ├── Attendance Management

    ├── Assessment Management

    └── Reporting
    
---

# 3. Authentication & Authorization

## Login

Actor:

- Administrator
- Teacher
- Student

Flow:
User opens login page

    ↓

Input credentials

    ↓

System validates account

    ↓

System redirects based on role

---

## Manage Permission

Actor:

- Administrator

Use cases:

- Create role
- Update role
- Assign permission
- Remove permission

---

# 4. User Management

Actor:

- Administrator

Use cases:

## Create User

Purpose:

Create a new system account.

Flow:
Admin opens user management

    ↓

Click create user

    ↓

Input user information

    ↓

Assign role

    ↓

Save user

---

## Update User

Purpose:

Update user information.

---

## Delete User

Purpose:

Remove user access from system.

---

# 5. Academic Structure Management

Actor:

- Administrator

Academic structure manages the foundation of academic activities.

Use cases:

- Manage academic year
- Manage semester
- Manage class
- Manage subject

---

## Academic Year

Functions:

- Create academic year
- Activate academic year
- Close academic year

---

## Semester

Functions:

- Create semester
- Activate semester
- Manage semester status

---

## Class Management

Functions:

- Create class
- Assign teacher
- Assign students

---

## Subject Management

Functions:

- Create subject
- Update subject
- Assign subject to class

---

# 6. Student Management

Actor:

- Administrator

Use cases:

- Create student
- View student
- Update student
- Delete student
- Assign student to class
- Import student data
- Export student data

---

## Create Student

Purpose:

Register a new student into the system.

Flow:
Admin opens student management

    ↓

Input student data

    ↓

System validates data

    ↓

Student record created

---

# 7. Teacher Management

Actor:

- Administrator

Use cases:

- Create teacher
- Update teacher profile
- Assign teaching responsibility
- View teacher information

---

# 8. Learning Process

Learning process is the core entity of the system.

Actors:

- Teacher
- Administrator

Use cases:

- Create teaching schedule
- Manage learning session
- Record learning activity

---

## Teaching Schedule

Purpose:

Define when and where learning occurs.

Information:

- Teacher
- Subject
- Class
- Schedule time

---

## Learning Session

Purpose:

Represent actual teaching activity.

Relationship:
Teaching Schedule

    ↓

Learning Session

    ↓

Attendance

    ↓

Assessment

---

# 9. Attendance Management

Actors:

- Teacher
- Administrator

Use cases:

- Record attendance
- Update attendance
- View attendance history
- Generate attendance report

---

## Attendance Status

Initial status:
Present

Absent

Sick

Permission

Late

The system should support configurable attendance statuses.

---

# 10. Assessment Management

Actors:

- Teacher
- Administrator

Use cases:

- Create assessment
- Input scores
- Update scores
- Calculate final grade
- View student grades

---

Assessment types:
Assignment

Quiz

Mid Exam

Final Exam

Assessment types should be configurable.

---

# 11. Reporting

Actors:

- Administrator
- Teacher
- Student

Use cases:

- View academic report
- Export report
- Print report

Reports:

- Student report
- Attendance report
- Grade report
- Class report

Export formats:

- PDF
- Excel
- CSV
- Print

---

# 12. Core Business Relationship

The main relationship:
Student

↓

Class

↓

Teaching Schedule

↓

Learning Session

↓

Attendance

↓

Assessment

↓

Academic Report

Learning Process is the central activity connecting academic data.

---

# 13. Future Use Cases

Possible future expansion:

- Parent portal
- Library management
- Finance management
- Online learning
- Communication system
- Mobile application

---

# Status

This document defines the initial system use cases.

Detailed scenarios and acceptance criteria will be expanded during functional requirement analysis.
