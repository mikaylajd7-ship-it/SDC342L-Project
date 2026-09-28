# Customer Complaint Management System

## Project Overview

This project is a PHP-based customer complaint management system developed using the MVC architecture. The application allows customers to submit and manage complaints, while technicians and administrators can manage complaint information based on their assigned roles.

The application uses PHP, MySQL, PDO, HTML, CSS, and session-based authentication and authorization.

## Week 2: Creating the Database and Application Framework

- Created the MySQL database for the application.
- Created tables for customers, employees, products/services, complaint types, complaints, and technician notes.
- Established the initial MVC folder structure.
- Created the initial application pages and forms.
- Created the GitHub repository and project structure.

## Week 3: Database Support and Object-Model Representation

- Added PHP database support using PDO.
- Created PHP model classes for the database tables.
- Created controller classes for database operations.
- Implemented CRUD operations using prepared statements.
- Added database connection and query testing.
- Connected the PHP application to the MySQL database.

## Week 4: Site Security

- Added session-based user authentication.
- Added customer and employee login support.
- Added secure password verification using PHP password hashing functions.
- Added logout functionality.
- Added protected pages that require authentication.
- Added authorization based on employee roles.
- Added separate access handling for customers, technicians, and administrators.
- Added session regeneration after successful login.
- Added testing for invalid login attempts, logout, protected pages, and unauthorized access.

### Week 4 Security Files

The following files were added:

```text
config/
└── auth.php

models/
└── User.php

controllers/
└── AuthController.php

views/
├── login.php
├── dashboard.php
└── logout.php
