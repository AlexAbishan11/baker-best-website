<?php
include('config/dbconnect.php'); 

// Get product name from index/menu page
$product = isset($_GET['product']) ? $_GET['product'] : '';
?>

<?php
    if (isset($_POST['submit'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $productName = $conn->real_escape_string($_POST['product']);
    $quantity = intval($_POST['quantity']);
    $additionalMessage = $conn->real_escape_string($_POST['message']);

    // Full message combining product and additional message
    $fullMessage = "Order: $productName " . nl2br($additionalMessage);

    // Insert into database
    $sql = "INSERT INTO orders (name, email, phone, address, message, quantity, date) 
        VALUES ('$name', '$email', '$phone', '$address', '$fullMessage', $quantity, CURDATE())";


    if ($conn->query($sql) === TRUE) {
        // Redirect BEFORE output
        header("Location: menu.php?order=success");
        exit();
    } else {
        $error = "Error: " . $conn->error;
    }
}

// Get product name from index/menu page
$product = isset($_GET['product']) ? $_GET['product'] : '';

include('navbar.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order | Baker Best</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link href="assets/css/style.css" rel="stylesheet">
    <style>

    </style>
</head>
<body class="order-page">

<div class="container my-5">
     <div style="text-align: center;"> 
    <h2 style="
        display: inline-block;
        background-color: #5c4033;
        color: white;
        padding: 15px 180px;
        border-radius: 15px;
        font-family: 'Dancing Script', cursive;
        margin: 15;
        ">
      Place Your Order
    </h2>
  </div>

    <!-- Order Form -->
    <form method="POST" class="mx-auto shadow p-4 rounded bg-white" style="max-width:600px;">
        <div class="mb-3">
            <label for="name" class="form-label">Your Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Your Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter your phone number" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Delivery Address</label>
            <textarea name="address" id="address" class="form-control" rows="2" placeholder="Enter your delivery address" required></textarea>
        </div>

        <div class="mb-3">
            <label for="product" class="form-label">Product</label>
            <input type="text" name="product" id="product" class="form-control" value="<?= htmlspecialchars($product) ?>" >
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" required>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Additional Message</label>
            <textarea name="message" id="message" class="form-control" rows="3" placeholder="Any special requests?"></textarea>
        </div>

        <div class="text-center">
        <button type="submit" name="submit" class="btn btn-warning fw-bold px-4 py-2">Submit Order</button>
        </div>
    </form>
    </div>

<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!-- 41readonly -->