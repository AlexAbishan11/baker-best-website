<?php
session_start();

// Debug: Check session status
echo "<!-- Session Debug: ";
var_dump($_SESSION);
echo " -->";

// Only allow logged-in admin
if(!isset($_SESSION['admins'])){
    header('Location: admin_login.php');
    exit();
}

// Include DB and navbar
include('./config/dbconnect.php');
include('admin_navbar.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Baker Best | Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('./assets/images/admin_bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .table thead {
            background-color: #4b3832;
            color: #fff;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
            color: #000;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .btn-action {
            margin: 0 2px;
        }
        .table-custom thead th {
            background-color: #4b3832;
            color: #f7f4f4ff !important;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <div style="text-align: center;"> 
        <h2 style="
            display: inline-block;
            background-color: #5c4033;
            color: white;
            padding: 15px 100px;
            border-radius: 15px;
            font-family: 'Dancing Script', cursive;
            margin: 15;
        ">Admin Dashboard</h2>
    </div>

    <!-- Add Product Button -->
    <div class="mb-3 text-end">
        <a href="add_product.php" class="btn btn-success">Add Product</a>
    </div>

    <?php
    $sql = "SELECT * FROM products ORDER BY id DESC";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        echo '<div class="table-responsive">
                <table class="table table-bordered table-striped table-custom text-center">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>'.htmlspecialchars($row['name']).'</td>
                    <td>Rs. '.number_format($row['price'], 2).'</td>
                    <td><img src="./assets/images/'.$row['image'].'" height="40"></td>
                    <td>
                        <a href="edit_product.php?id='.$row['id'].'" class="btn btn-primary btn-sm btn-action">Edit</a>
                        <a href="delete_product.php?id='.$row['id'].'" class="btn btn-danger btn-sm btn-action" onclick="return confirm(\'Are you sure?\')">Delete</a>
                    </td>
                </tr>';
        }
        echo '</tbody></table></div>';
    } else {
        echo "<div class='alert alert-info'>No products found.</div>";
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
