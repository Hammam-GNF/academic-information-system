# Academic Information System Functional Requirements

This document defines the functional requirements of the Academic Information System.

Functional requirements describe what the system must provide to support academic activities in schools.

This document becomes the reference before database design and module implementation.

---

# Functional Requirement Structure

Each requirement contains:

- Module
- Actor
- Description
- Expected Behavior

---

# 1. Authentication & User Management

## FR-AUTH-001 — User Login

Actor:

- Admin
- Teacher
- Student
- Other registered users

Description:

The system must provide authentication functionality for users.

Expected Behavior:

- User enters credentials.
- System validates credentials.
- System redirects user based on their role.

---

## FR-AUTH-002 — Profile Management

Actor:

- All users

Description:

Users can manage their own profile information.

Expected Behavior:

- Update personal information.
- Change password.
- Update profile photo.

---

# 2. Authorization & Permission

## FR-AUTHZ-001 — Role Based Access Control

Actor:

- Administrator

Description:

The system must restrict access based on user roles and permissions.

Expected Behavior:

- Admin manages roles and permissions.
- Users only access authorized features.

---

# 3. Academic Structure Management

## FR-ACADEMIC-001 — Academic Year Management

Actor:

- Administrator

Description:

System manages academic periods.

Expected Behavior:

- Create academic year.
- Activate academic year.
- Close academic year.

---

## FR-ACADEMIC-002 — Semester Management

Actor:

- Administrator

Description:

System manages semester periods.

Expected Behavior:

- Create semester.
- Set active semester.

---

## FR-ACADEMIC-003 — Class Management

Actor:

- Administrator

Description:

System manages school classes.

Expected Behavior:

- Create class.
- Assign homeroom teacher.
- Manage student membership.

---

## FR-ACADEMIC-004 — Subject Management

Actor:

- Administrator

Description:

System manages subjects.

Expected Behavior:

- Create subjects.
- Assign subjects to curriculum structure.

---

# 4. Student Management

## FR-STUDENT-001 — Student Data Management

Actor:

- Administrator

Description:

System manages student information.

Expected Behavior:

- Create student profile.
- Update student data.
- View student information.

---

## FR-STUDENT-002 — Student Class Assignment

Actor:

- Administrator

Description:

System manages student placement.

Expected Behavior:

- Assign students to classes.
- Track student academic history.

---

# 5. Teacher Management

## FR-TEACHER-001 — Teacher Data Management

Actor:

- Administrator

Description:

System manages teacher information.

Expected Behavior:

- Create teacher profile.
- Update teacher data.

---

## FR-TEACHER-002 — Teaching Assignment

Actor:

- Administrator

Description:

System manages teacher responsibilities.

Expected Behavior:

- Assign teacher to subjects.
- Assign teacher to classes.

---

# 6. Learning Process

## FR-LEARNING-001 — Teaching Schedule Management

Actor:

- Administrator

Description:

System manages teaching schedules.

Expected Behavior:

- Create schedule.
- Assign teacher.
- Assign subject.
- Assign class.

---

## FR-LEARNING-002 — Learning Activity Management

Actor:

- Teacher

Description:

System records learning activities.

Expected Behavior:

- Teacher records learning session.
- System stores learning history.

---

# 7. Attendance Management

## FR-ATTENDANCE-001 — Attendance Recording

Actor:

- Teacher

Description:

System allows teachers to record student attendance.

Expected Behavior:

- Select learning session.
- Record attendance status.
- Save attendance records.

---

## FR-ATTENDANCE-002 — Attendance Reporting

Actor:

- Administrator
- Teacher

Description:

System provides attendance reports.

Expected Behavior:

- View attendance summary.
- Filter by student/class/period.

---

# 8. Assessment Management

## FR-ASSESSMENT-001 — Assessment Type Management

Actor:

- Teacher
- Administrator

Description:

System manages assessment categories.

Examples:

- Assignment
- Quiz
- Exam
- Project

---

## FR-ASSESSMENT-002 — Score Input

Actor:

- Teacher

Description:

Teachers can input student scores.

Expected Behavior:

- Select class.
- Select subject.
- Input scores.
- Save assessment results.

---

## FR-ASSESSMENT-003 — Grade Calculation

Actor:

- Teacher
- Administrator

Description:

System calculates final grades based on configured rules.

Expected Behavior:

- Calculate final score.
- Generate grade summary.

---

# 9. Reporting

## FR-REPORT-001 — Academic Report

Actor:

- Administrator
- Teacher

Description:

System provides academic reports.

Expected Behavior:

- Generate student reports.
- Export reports.

---

# Requirement Status

Current status:

Completed:
- Requirement categories defined.
- Core modules identified.
- Main actors identified.

Next:

- Database design.
- Module dependency analysis.
- Implementation planning.
