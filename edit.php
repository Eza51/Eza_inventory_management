<?php
// edit.php
// Inventory Management System - PHP Code
// Created by: Nowshin Eza
// This system handles CRUD operations (Create, Read, Update, Delete) for managing products in an inventory.
$conn = new mysqli('localhost', 'root', '', 'inventory_management');
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id=$id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        input[type="text"], input[type="number"], input[type="submit"] {
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        label {
            font-weight: bold;
            color: #333;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group input {
            width: 100%;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .back-link a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }
        .back-link a:hover {
            color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Edit Product</h2>

        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" id="product_name" value="<?php echo $row['product_name']; ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" value="<?php echo $row['description']; ?>" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" name="price" id="price" value="<?php echo $row['price']; ?>" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" value="<?php echo $row['quantity']; ?>" required>
            </div>

            <input type="submit" value="Update">
        </form>

        <div class="back-link">
            <a href="display.php">Back to Product List</a>
        </div>
    </div>

</body>
</html>
