# Academic Information System Database Design

This document describes the database design foundation for the Academic Information System.

The design focuses on academic domain modeling and future scalability.

The database structure is designed before implementation to prevent inconsistent data models.

---

# Database Design Principles

The database should support:

- Academic data consistency
- Historical academic records
- Flexible configuration
- Multi-level school implementation
- Future module expansion

---

# Domain Overview

The system is divided into several domains:
User Management

    |

Academic Structure

    |

Learning Process

    |

Assessment & Reporting

---

# 1. User Management Domain

## User

Purpose:

Stores authentication accounts.

Attributes:

- id
- name
- email
- password
- role information

Relationship:
User

has one

Teacher / Student

---

## Role & Permission

Purpose:

Controls system authorization.

Entities:

- Role
- Permission

Implementation:

Using Spatie Permission package.

---

# 2. Academic Structure Domain

## Academic Year

Purpose:

Stores academic periods.

Example:
2026/2027


Relationship:


Academic Year

has many

Semester

---

## Semester

Purpose:

Represents academic term.

Example:
Odd Semester
Even Semester


Relationship:


Semester

belongs to

Academic Year

---

## Department

Purpose:

Stores academic grouping.

Example:

- Science
- Social
- Software Engineering

Optional depending on school type.

---

## Class

Purpose:

Represents student learning groups.

Example:
Class 7A
Class 10 RPL 1


Relationship:


Class

belongs to

Academic Year

Class

has many

Students

---

## Subject

Purpose:

Stores learning subjects.

Example:

- Mathematics
- Science
- Programming

---

# 3. Student Domain

## Student

Purpose:

Stores student identity information.

Attributes:

- id
- student_number
- name
- birth_date
- gender

Relationship:
Student

belongs to

Class

Student

has many

Attendance Records

Student

has many

Scores

---

# 4. Teacher Domain

## Teacher

Purpose:

Stores teacher information.

Attributes:

- id
- employee_number
- name

Relationship:
Teacher

belongs to

User

Teacher

has many

Teaching Assignments

---

# 5. Learning Process Domain

## Teaching Assignment

Purpose:

Defines teacher responsibility.

Relationship:
Teacher

teaches

Subject

for

Class

---

## Teaching Schedule

Purpose:

Stores learning timetable.

Relationship:
Schedule

belongs to

Teaching Assignment

---

## Learning Session

Purpose:

Represents actual classroom activity.

Example:
Mathematics

Class 7A

Monday 08:00


Relationship:


Learning Session

belongs to

Schedule

---

# 6. Attendance Domain

## Attendance

Purpose:

Stores student attendance records.

Status example:
Present
Absent
Permission
Sick


Relationship:


Learning Session

has many

Attendance

Student

has many

Attendance

---

# 7. Assessment Domain

## Assessment

Purpose:

Defines evaluation activity.

Example:
Quiz 1

Mid Exam

Final Exam


Relationship:


Subject

has many

Assessments

---

## Score

Purpose:

Stores student evaluation result.

Relationship:
Student

has many

Scores

Assessment

has many

Scores

---

# 8. Reporting Domain

## Academic Report

Purpose:

Generates student academic summary.

Contains:

- Grade summary
- Attendance summary
- Learning progress

---

# Core Entity Relationship Overview
AcademicYear

|

Semester

|

Class

|

Student

Teacher

|

TeachingAssignment

|

Schedule

|

LearningSession

|

Attendance

Subject

|

Assessment

|

Score

---

# Future Expansion

The design allows future modules:

- Curriculum Management
- Digital Learning
- Library System
- Finance System
- Parent Portal
- Student Admission
- School Information Dashboard

---

# Design Status

Completed:

- Core domain identified
- Main entities identified
- Initial relationships defined

Next:

- Module dependency analysis
- Database normalization review
- Migration planning
