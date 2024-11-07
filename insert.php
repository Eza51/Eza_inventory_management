<?php
// insert.php
// Inventory Management System - PHP Code
// Created by: Nowshin Eza
// This system handles CRUD operations (Create, Read, Update, Delete) for managing products in an inventory.
$conn = new mysqli('localhost', 'root', '', 'inventory_management');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO products (product_name, description, price, quantity)
            VALUES ('$product_name', '$description', '$price', '$quantity')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
