<?php
session_start();

// Check if admin is logged in
if(!isset($_SESSION['admins'])){
    header('Location: admin_login.php');
    exit();
}

include('./config/dbconnect.php');
include('admin_navbar.php');

if(isset($_POST['submit'])){
    $name = $conn->real_escape_string($_POST['name']);
    $price = $conn->real_escape_string($_POST['price']);
    // $description = $conn->real_escape_string($_POST['description']);

    // Image upload
    $imageName = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];
    $uploadDir = "./assets/images/";
    move_uploaded_file($tmpName, $uploadDir.$imageName);

    $sql = "INSERT INTO products (name, price, image) VALUES ('$name','$price','$imageName')";
    if($conn->query($sql) === TRUE){
        // Redirect to dashboard immediately after add
        header("Location: admin_dashboard.php?msg=Product+added+successfully");
        exit;
    } else {
        $msg = "Error: ".$conn->error;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
       
body {
            background-image: url('./assets/images/admin_bg.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
/* Custom label styling */
        .custom-label {
            background-color:#4b3832; 
            color: #f3f1f1ff;               
            padding: 5px 10px;         
            border-radius: 5px;        
            font-weight: bold;          
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
        padding: 15px 170px;
        border-radius: 15px;
        font-family: 'Dancing Script', cursive;
        margin: 15;
        ">Add Product</h2>
    </div>
    <?php if(isset($msg)){ echo "<div class='alert alert-info text-center'>$msg</div>"; } ?>
    <form method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width:500px;">
        <div class="mb-3">
    <label class="custom-label">Name</label>
    <input type="text" name="name" class="form-control" required>
</div>
        <div class="mb-3">
            <label class="custom-label">Price</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="custom-label">Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        
        <button type="submit" name="submit" class="btn btn-success w-100">Add Product</button>
    </form>
</div>

</body>
</html>
