# SDC310 Week 2 Project

## Customer Complaint System

This project is the Week 2 foundation for the Advanced Server-Side Scripting with PHP course project.

### Week 2 work
- Created the MySQL database and related tables.
- Created the initial PHP project directory structure.
- Added initial registration, login, complaint, dashboard, and home pages.
- Added the database connection configuration.
- Added starter MVC folders for models, views, and controllers.

## Running locally

1. Start Apache and MySQL in XAMPP.
2. Import `database/sdc310_complaints.sql` into phpMyAdmin.
3. Place the project folder inside `C:\xampp\htdocs`.
4. Open:
   `http://localhost/sdc310_week2_project/`

## Database
Database name: `sdc310_complaints`

The database contains:
- customers
- employees
- products_services
- complaint_types
- complaints
- technician_notes

Authentication, authorization, complete CRUD operations, file uploads, and final application functionality will be developed in later weeks.


## Week 3: Database Support and MVC

Week 3 expands the Week 2 project by representing the MySQL database in PHP using MVC.

### Database
The application uses the `sdc310_complaints` MySQL database with these tables:

- customers
- employees
- products_services
- complaint_types
- complaints
- technician_notes

### Models
The `models` folder contains PHP classes for the database tables. The model classes use PDO through `models/Database.php` and provide read and CRUD operations.

### Controllers
The `controllers` folder contains controller classes that call the model methods. This provides the MVC connection between the application and the database.

### Database Test
Open:

`http://localhost/<project-folder>/database_test.php`

The test page loads records from the database through the PHP model classes. A successful page confirms that PHP can connect to MySQL and retrieve data.

### Database Configuration
The project currently expects:

- Host: `localhost`
- Database: `sdc310_complaints`
- Username: `root`
- Password: blank

If the local MySQL root account uses a password, update `models/Database.php`.

### Week 3 CRUD
The models include Create, Read, Update, and Delete methods for the application's main database entities. Prepared statements are used for database operations.

