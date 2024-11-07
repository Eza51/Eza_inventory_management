<?php
// update.php
// Inventory Management System - PHP Code
// Created by: Nowshin Eza
// This system handles CRUD operations (Create, Read, Update, Delete) for managing products in an inventory.
$conn = new mysqli('localhost', 'root', '', 'inventory_management');
$id = $_POST['id'];
$product_name = $_POST['product_name'];
$description = $_POST['description'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];

$sql = "UPDATE products SET product_name='$product_name', description='$description', price='$price', quantity='$quantity' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
