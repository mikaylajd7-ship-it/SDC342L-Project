-- SDC310 Week 2 Project Database
-- Advanced Server-Side Scripting with PHP
-- Database: sdc310_complaints

CREATE DATABASE IF NOT EXISTS sdc310_complaints
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE sdc310_complaints;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS technician_notes;
DROP TABLE IF EXISTS complaints;
DROP TABLE IF EXISTS complaint_types;
DROP TABLE IF EXISTS products_services;
DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS customers;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE customers (
    customer_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(25),
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE employees (
    employee_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('technician', 'administrator') NOT NULL DEFAULT 'technician',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE products_services (
    product_service_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    item_type ENUM('product', 'service') NOT NULL,
    active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE complaint_types (
    complaint_type_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    type_name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    active TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

CREATE TABLE complaints (
    complaint_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_id INT UNSIGNED NOT NULL,
    product_service_id INT UNSIGNED,
    complaint_type_id INT UNSIGNED NOT NULL,
    assigned_employee_id INT UNSIGNED,
    subject VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    status ENUM('submitted', 'assigned', 'in_progress', 'resolved', 'closed')
        NOT NULL DEFAULT 'submitted',
    priority ENUM('low', 'medium', 'high', 'urgent')
        NOT NULL DEFAULT 'medium',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_complaints_customer
        FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
        ON DELETE CASCADE ON UPDATE CASCADE,

    CONSTRAINT fk_complaints_product_service
        FOREIGN KEY (product_service_id) REFERENCES products_services(product_service_id)
        ON DELETE SET NULL ON UPDATE CASCADE,

    CONSTRAINT fk_complaints_type
        FOREIGN KEY (complaint_type_id) REFERENCES complaint_types(complaint_type_id)
        ON DELETE RESTRICT ON UPDATE CASCADE,

    CONSTRAINT fk_complaints_employee
        FOREIGN KEY (assigned_employee_id) REFERENCES employees(employee_id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE technician_notes (
    note_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    complaint_id INT UNSIGNED NOT NULL,
    employee_id INT UNSIGNED NOT NULL,
    note_text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_notes_complaint
        FOREIGN KEY (complaint_id) REFERENCES complaints(complaint_id)
        ON DELETE CASCADE ON UPDATE CASCADE,

    CONSTRAINT fk_notes_employee
        FOREIGN KEY (employee_id) REFERENCES employees(employee_id)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Sample products/services
INSERT INTO products_services (name, description, item_type) VALUES
('Laptop Support', 'Technical support for laptop hardware and software issues.', 'service'),
('Desktop Support', 'Technical support for desktop computer issues.', 'service'),
('Network Setup', 'Setup and troubleshooting for home and small business networks.', 'service'),
('Laptop Pro 15', 'Example laptop product used for project testing.', 'product');

-- Sample complaint types
INSERT INTO complaint_types (type_name, description) VALUES
('Product Issue', 'A problem with a purchased product.'),
('Service Issue', 'A problem with a service that was provided.'),
('Billing Issue', 'A question or complaint involving billing or charges.'),
('Technical Support', 'A technical problem requiring troubleshooting.'),
('Other', 'A complaint that does not fit another category.');

-- Sample customer and employee records.
-- These are test records only. Replace password_hash values with real
-- password_hash() results when authentication is implemented.
INSERT INTO customers
    (first_name, last_name, email, phone, password_hash)
VALUES
    ('Test', 'Customer', 'customer@example.com', '555-0100', 'TEST_HASH');

INSERT INTO employees
    (first_name, last_name, email, password_hash, role)
VALUES
    ('Test', 'Technician', 'technician@example.com', 'TEST_HASH', 'technician'),
    ('Test', 'Administrator', 'admin@example.com', 'TEST_HASH', 'administrator');

-- Example complaint
INSERT INTO complaints
    (customer_id, product_service_id, complaint_type_id, assigned_employee_id,
     subject, description, status, priority)
VALUES
    (1, 1, 4, 1,
     'Example technical support request',
     'This is sample data for testing the complaint workflow.',
     'assigned', 'medium');

-- Example technician note
INSERT INTO technician_notes
    (complaint_id, employee_id, note_text)
VALUES
    (1, 1, 'Initial review completed. This is sample testing data.');
