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

// Check if product ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: admin_dashboard.php");
    exit();
}

$id = intval($_GET['id']);

// Fetch product data
$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "<div class='alert alert-danger text-center mt-5'>Product not found.</div>";
    exit();
}

$product = $result->fetch_assoc();

// Handle form submission
if (isset($_POST['update'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $price = floatval($_POST['price']);
    $imageName = $product['image']; // default existing image

    // Handle image upload if a new file is selected
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../assets/images/";
        $imageName = basename($_FILES['image']['name']);
        $targetFile = $targetDir . $imageName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            echo "<div class='alert alert-warning text-center'>Image upload failed. Keeping old image.</div>";
            $imageName = $product['image']; // keep old image if upload fails
        }
    }

    // Update product in DB
    $updateSql = "UPDATE products SET name='$name', price=$price, image='$imageName' WHERE id=$id";

    if ($conn->query($updateSql) === TRUE) {
        header("Location: admin_dashboard.php?msg=Product updated successfully");
        exit();
    } else {
        echo "<div class='alert alert-danger text-center mt-3'>Error updating product: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('./assets/images/admin_bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .edit-form {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            max-width: 600px;
            margin: 40px auto;
        }
        .edit-header {
    background-color: #5c4033; /* header background */
    padding: 15px 30px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}

.edit-header h2 {
    color: white;
    font-family: 'Dancing Script', cursive;
    margin: 0;
    font-size: 2rem;
}
</style>
    </style>
</head>
<body>
<div class="edit-header d-flex align-items-center justify-content-center mb-4">
    <img src="./assets/images/logo1.png" alt="Baker Best Logo" width="95" height="60" class="me-3">
    <h2>Edit Product</h2>
</div>

    <form method="POST" enctype="multipart/form-data" class="edit-form">
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Price (Rs.)</label>
            <input type="number" name="price" class="form-control" value="<?= htmlspecialchars($product['price']) ?>" step="0.01" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            <img src="./assets/images/<?= htmlspecialchars($product['image']) ?>" height="100">
        </div>

        <div class="mb-3">
            <label class="form-label">Change Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="text-center">
            <button type="submit" name="update" class="btn btn-warning px-4 fw-bold">Update Product</button>
            <a href="admin_dashboard.php" class="btn btn-secondary px-4">Cancel</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
