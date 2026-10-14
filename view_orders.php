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

include('./config/dbconnect.php');
include('admin_navbar.php');

// ✅ Handle "Complete" action
if (isset($_GET['complete'])) {
    $order_id = intval($_GET['complete']);
    $update = "UPDATE orders SET status='Completed' WHERE id=$order_id";
    if ($conn->query($update)) {
        header("Location: view_orders.php?msg=The+order+has+been+delivered.");
        exit();
    } else {
        header("Location: view_orders.php?msg=Error+updating+status");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Orders | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
body {
    background-image: url('./assets/images/admin_bg.jpg'); 
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

.table-custom thead th {
    background-color: #4b3832 !important;
    color: #f7f4f4ff !important;
    font-weight: bold;
    text-align: center;
}

.btn-complete {
    background-color: #198754;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 5px 12px;
    text-decoration: none;
}

.btn-complete:hover {
    background-color: #157347;
    color: white;
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
            padding: 15px 90px;
            border-radius: 15px;
            font-family: 'Dancing Script', cursive;
            margin: 10;
        ">
            Customer Orders
        </h2>
    </div>

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success text-center"><?= htmlspecialchars($_GET['msg']) ?></div>
    <?php endif; ?>

    <?php
    $sql = "SELECT * FROM orders ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo '<div class="table-responsive">
                <table class="table table-bordered table-striped table-custom text-center">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Orders</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['phone'].'</td>
                    <td>'.$row['address'].'</td>
                    <td>'.$row['message'].'</td>
                    <td>'.$row['quantity'].'</td>
                    <td>'.$row['date'].'</td>
                    <td>'.$row['status'].'</td>
                    <td>';
            if ($row['status'] === 'Pending') {
                echo '<a href="?complete='.$row['id'].'" class="btn btn-complete">Complete</a>';
            } else {
                echo '<span class="badge bg-success">Delivered</span>';
            }
            echo '</td></tr>';
        }
        echo '</tbody></table></div>';
    } else {
        echo "<div class='alert alert-info text-center'>No orders found.</div>";
    }
    ?>
</div>
</body>
</html>
