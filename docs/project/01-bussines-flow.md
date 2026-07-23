# Academic Information System Business Flow

This document describes the business flow of the Academic Information System.

The purpose of this document is to define how academic processes work before implementation begins.

The system is designed around academic activities, where learning processes become the core business entity.

---

# 1. High Level Business Flow

The main academic ecosystem:
nstitution
│
▼
Academic Structure
│
├── Academic Year
├── Semester
├── Class
├── Subject
│
▼
Learning Process
│
├── Teaching Schedule
├── Attendance
├── Assessment
└── Learning Records
│
▼
Academic Report

The system focuses on managing the complete student academic lifecycle.

---

# 2. User Flow

## Administrator

Responsible for managing the academic system.

Flow:
Login
│
▼
Dashboard
│
├── Manage Users
│
├── Manage Academic Structure
│
├── Manage Students
│
├── Manage Teachers
│
├── Manage Classes
│
├── Manage Subjects
│
├── Manage Settings
│
▼
Monitor Academic Activities



---

## Teacher

Responsible for learning activities.

Flow:
Login
│
▼
Teacher Dashboard
│
├── View Teaching Schedule
│
├── Manage Attendance
│
├── Input Assessment
│
└── View Student Progress

---

## Student

Responsible for accessing academic information.

Flow:
Login
│
▼
Student Dashboard
│
├── View Schedule
│
├── View Attendance
│
├── View Grades
│
└── View Academic Report

---

# 3. Academic Lifecycle

The academic lifecycle:
Academic Year Created
│
▼
Semester Activated
│
▼
Student Registered
│
▼
Student Assigned To Class
│
▼
Subjects Assigned
│
▼
Learning Process Started
│
▼
Attendance Recorded
│
▼
Assessment Recorded
│
▼
Report Generated

---

# 4. Student Lifecycle

Student lifecycle:
Candidate Student
│
▼
Student Registration
│
▼
Active Student
│
▼
Class Assignment
│
▼
Learning Participation
│
▼
Graduation / Withdrawal

---

# 5. Learning Process Flow

Learning is the core entity of the system.

Flow:
Teacher
│
▼
Teaching Schedule
│
▼
Learning Session
│
├── Attendance
│
├── Learning Material
│
└── Assessment

Every academic activity should be connected to the learning process.

---

# 6. Attendance Flow

Attendance management:
Teacher Opens Schedule
│
▼
Select Learning Session
│
▼
Record Student Attendance
│
▼
Save Attendance Data
│
▼
Attendance Report

Attendance status should be extensible.

Initial status:
Present
Absent
Permission
Sick
Late

Future possibility:

- Custom attendance status
- Attendance percentage calculation
- Parent notification

---

# 7. Assessment Flow

Assessment process:
Teacher
│
▼
Select Subject
│
▼
Select Class
│
▼
Input Assessment
│
├── Assignment
├── Quiz
├── Mid Exam
└── Final Exam
│
▼
Calculate Final Score
│
▼
Generate Report

Assessment type should be configurable.

---

# 8. Reporting Flow

Academic reporting:
Academic Data
│
├── Attendance
│
├── Assessment
│
├── Student Profile
│
▼
Academic Report

Reports:

- Student Report
- Attendance Report
- Grade Report
- Class Report

Export support:

- PDF
- Excel
- CSV
- Print

---

# 9. Business Rules

## Learning as Core Entity

All academic activities should relate to learning.

Example:

Attendance:
Student
↓
Learning Session
↓
Attendance

Assessment:
Student
↓
Learning Session
↓
Assessment


---

## Permission Rules

System uses role-based access control.

Initial roles:
Administrator
Teacher
Student


Additional roles can be added later.

---

## Academic Data Isolation

Academic data should follow:


Institution
↓
Academic Year
↓
Semester
↓
Class
↓
Student


---

# 10. Future Expansion

Possible future modules:

- Parent Portal
- Library Management
- Finance Management
- Online Learning
- Communication System
- Mobile Application
- External API Integration