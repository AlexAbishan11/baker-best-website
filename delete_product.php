<?php
session_start();
include('./config/dbconnect.php');

// Only allow logged-in admin
if(!isset($_SESSION['admins'])){
    header('Location: admin_login.php');
    exit();
}

// Check if product ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: admin_dashboard.php");
    exit();
}

$id = intval($_GET['id']);

// Delete product from database
$deleteSql = "DELETE FROM products WHERE id = $id";
if ($conn->query($deleteSql) === TRUE) {
    header("Location: admin_dashboard.php?msg=Product deleted successfully");
    exit();
} else {
    echo "Error deleting product: " . $conn->error;
}
?>
