# Academic Information System Entity Relationship Overview

This document defines the high-level relationships between the core entities of the Academic Information System.

The purpose of this document is to establish a consistent data model before creating database migrations and implementing modules.

---

# Relationship Principles

The entity relationships are designed to support:

- Clear separation of academic domains
- Historical academic records
- Flexible academic configuration
- Modular application growth
- Future feature expansion

The Learning Process remains the central domain connecting academic activities.

---

# Domain Relationship Overview

```
Institution
    │
    ▼
Academic Structure
    │
    ▼
Learning Process
    │
    ▼
Assessment
    │
    ▼
Academic Reporting
```

---

# 1. User Management Domain

```
User
│
├── Teacher
│
├── Student
│
└── Administrator (Role)
```

Relationships

- One User can represent one Teacher.
- One User can represent one Student.
- Authorization is managed using Roles and Permissions.

---

# 2. Academic Structure Domain

```
Academic Year
    │
    ▼
Semester
    │
    ▼
Department (Optional)
    │
    ▼
Class
```

Relationships

- Academic Year has many Semesters.
- Semester belongs to Academic Year.
- Department can have many Classes.
- Class belongs to Academic Year.
- Department is optional depending on institution type.

---

# 3. Student Domain

```
Student
    │
    ├── belongs to Class
    │
    ├── has many Attendance
    │
    ├── has many Scores
    │
    └── has many Academic Reports
```

Student records should preserve historical academic data across academic years.

---

# 4. Teacher Domain

```
Teacher
    │
    ├── has many Teaching Assignments
    │
    └── has many Learning Sessions
```

A teacher may teach multiple subjects and multiple classes.

---

# 5. Subject Domain

```
Subject
    │
    ├── has many Teaching Assignments
    │
    └── has many Assessments
```

Subjects should remain reusable across academic years.

---

# 6. Teaching Assignment Domain

Teaching Assignment represents the relationship between:

```
Teacher
    │
    ▼
Subject
    │
    ▼
Class
```

This entity becomes the academic responsibility definition.

---

# 7. Learning Domain

The Learning Process is the core entity.

```
Teaching Assignment
        │
        ▼
Teaching Schedule
        │
        ▼
Learning Session
```

Learning Session represents actual classroom activities.

Every attendance record and assessment originates from a Learning Session.

---

# 8. Attendance Domain

```
Learning Session
        │
        ▼
Attendance
        │
        ▼
Student
```

Attendance stores:

- Student
- Session
- Attendance Status
- Recorded Time

Attendance status should remain configurable.

---

# 9. Assessment Domain

```
Learning Session
        │
        ▼
Assessment
        │
        ▼
Score
        │
        ▼
Student
```

Assessment Types include:

- Assignment
- Quiz
- Practical
- Project
- Mid Examination
- Final Examination

Assessment types should be configurable instead of hardcoded.

---

# 10. Academic Reporting Domain

```
Attendance
        │
        ├──
Assessment
        │
        └──
Student
            │
            ▼
Academic Report
```

Academic reports summarize:

- Attendance
- Grades
- Learning Progress

Reports should support PDF, Excel, CSV, and Print exports.

---

# High-Level Entity Relationship

```
Academic Year
        │
        ▼
Semester
        │
        ▼
Class
        │
        ├──────────────┐
        ▼              │
Student              Teaching Assignment
                        │
            ┌───────────┴───────────┐
            ▼                       ▼
        Teacher                 Subject
            │
            ▼
Teaching Schedule
            │
            ▼
Learning Session
      ┌─────┴─────┐
      ▼           ▼
Attendance   Assessment
      │           │
      └─────┬─────┘
            ▼
     Academic Report
```

---

# Design Decisions

The entity relationship model follows several principles:

- Learning Session is the central business entity.
- Teaching Assignment connects teachers, subjects, and classes.
- Attendance and Assessment always belong to a Learning Session.
- Academic Reports are generated from accumulated academic records.
- Academic history must remain immutable after an academic period is completed.

---

# Next Step

After completing the Entity Relationship Overview, the project will define the Module Implementation Roadmap.

This roadmap will determine the implementation order of every module based on dependency analysis rather than feature priority.
