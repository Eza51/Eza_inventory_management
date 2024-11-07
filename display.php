<?php
// display.php
// Inventory Management System - PHP Code
// Created by: Nowshin Eza
// This system handles CRUD operations (Create, Read, Update, Delete) for managing products in an inventory.
$conn = new mysqli('localhost', 'root', '', 'inventory_management');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pagination logic
$limit = 10; // number of products per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM products LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Get the total number of products to calculate total pages
$total_result = $conn->query("SELECT COUNT(*) AS total FROM products");
$total_row = $total_result->fetch_assoc();
$total_pages = ceil($total_row['total'] / $limit);

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management - Display</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .actions {
            display: flex;
            justify-content: left;
            gap: 20px; /* Adds space between buttons */
        }
        .btn {
            text-decoration: none;
            padding: 8px 16px;
            color: white;
            border-radius: 4px;
            text-align: center;
            display: inline-block;
            font-weight: bold;
        }
        .btn-edit {
            background-color: #4CAF50; /* Green for Edit */
        }
        .btn-edit:hover {
            background-color: #45a049; /* Darker green on hover */
        }
        .btn-delete {
            background-color: #f44336; /* Red for Delete */
        }
        .btn-delete:hover {
            background-color: #d32f2f; /* Darker red on hover */
        }
        .btn:active {
            transform: scale(0.98);
        }

        /* Make the table responsive */
        @media (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            th, td {
                text-align: center;
                padding: 10px;
            }

            .actions {
                display: flex;
                justify-content: center;
                gap: 10px;
            }
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 0 5px;
        }

        .pagination a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Product List</h2>';

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Product Name</th><th>Description</th><th>Price</th><th>Quantity</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["product_name"]."</td><td>".$row["description"]."</td><td>".$row["price"]."</td><td>".$row["quantity"]."</td>";
        echo "<td class='actions'>
                <a href='edit.php?id=".$row["id"]."' class='btn btn-edit'>Edit</a>
                <a href='delete.php?id=".$row["id"]."' class='btn btn-delete' onclick='return confirm(\"Are you sure you want to delete this product?\");'>Delete</a>
              </td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>No products found.</p>";
}

echo '<div class="pagination">';
if ($page > 1) {
    echo "<a href='display.php?page=" . ($page - 1) . "'>Previous</a>";
}
if ($page < $total_pages) {
    echo "<a href='display.php?page=" . ($page + 1) . "'>Next</a>";
}
echo "</div>";

$conn->close();

echo '    </div>
</body>
</html>';
?>
