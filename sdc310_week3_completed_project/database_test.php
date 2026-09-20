<?php
require_once __DIR__ . '/models/Customer.php';
require_once __DIR__ . '/models/Complaint.php';
require_once __DIR__ . '/models/ProductService.php';
require_once __DIR__ . '/models/ComplaintType.php';
require_once __DIR__ . '/models/Employee.php';

$customerModel = new Customer();
$complaintModel = new Complaint();
$productModel = new ProductService();
$complaintTypeModel = new ComplaintType();
$employeeModel = new Employee();

$customers = $customerModel->getAll();
$complaints = $complaintModel->getAll();
$products = $productModel->getAll();
$types = $complaintTypeModel->getAll();
$employees = $employeeModel->getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SDC342 Week 3 Database Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f5f5f5; }
        h1 { color: #222; }
        .success { padding: 12px; background: #dff0d8; border: 1px solid #b8d8ad; margin-bottom: 20px; }
        section { background: white; padding: 18px; margin-bottom: 20px; border-radius: 6px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h1>SDC342 Week 3 Database Test</h1>

    <div class="success">
        PHP successfully connected to the <strong>sdc310_complaints</strong> database.
    </div>

    <section>
        <h2>Customers</h2>
        <table>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Phone</th>
            </tr>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= htmlspecialchars((string)$customer['customer_id']) ?></td>
                    <td><?= htmlspecialchars($customer['first_name'] . ' ' . $customer['last_name']) ?></td>
                    <td><?= htmlspecialchars($customer['email']) ?></td>
                    <td><?= htmlspecialchars($customer['phone'] ?? '') ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <section>
        <h2>Products and Services</h2>
        <table>
            <tr><th>ID</th><th>Name</th><th>Type</th><th>Active</th></tr>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars((string)$product['product_service_id']) ?></td>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['item_type']) ?></td>
                    <td><?= $product['active'] ? 'Yes' : 'No' ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <section>
        <h2>Complaint Types</h2>
        <table>
            <tr><th>ID</th><th>Type</th><th>Description</th></tr>
            <?php foreach ($types as $type): ?>
                <tr>
                    <td><?= htmlspecialchars((string)$type['complaint_type_id']) ?></td>
                    <td><?= htmlspecialchars($type['type_name']) ?></td>
                    <td><?= htmlspecialchars($type['description'] ?? '') ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <section>
        <h2>Employees</h2>
        <table>
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th></tr>
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?= htmlspecialchars((string)$employee['employee_id']) ?></td>
                    <td><?= htmlspecialchars($employee['first_name'] . ' ' . $employee['last_name']) ?></td>
                    <td><?= htmlspecialchars($employee['email']) ?></td>
                    <td><?= htmlspecialchars($employee['role']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <section>
        <h2>Complaints</h2>
        <table>
            <tr>
                <th>ID</th><th>Customer</th><th>Subject</th>
                <th>Status</th><th>Priority</th>
            </tr>
            <?php foreach ($complaints as $complaint): ?>
                <tr>
                    <td><?= htmlspecialchars((string)$complaint['complaint_id']) ?></td>
                    <td><?= htmlspecialchars($complaint['customer_name']) ?></td>
                    <td><?= htmlspecialchars($complaint['subject']) ?></td>
                    <td><?= htmlspecialchars($complaint['status']) ?></td>
                    <td><?= htmlspecialchars($complaint['priority']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
</body>
</html>
