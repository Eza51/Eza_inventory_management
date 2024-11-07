<?php
// delete.php
// Inventory Management System - PHP Code
// Created by: Nowshin Eza
// This system handles CRUD operations (Create, Read, Update, Delete) for managing products in an inventory.
$conn = new mysqli('localhost', 'root', '', 'inventory_management');
$id = $_GET['id'];
$sql = "DELETE FROM products WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
