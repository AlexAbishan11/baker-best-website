<?php
include('config/dbconnect.php'); 
include('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Baker Best | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet"> -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
h2{
    font-family: 'Dancing Script', cursive;
    background-color:#5c4033;
    color: #ffffffff;
    padding: 15px;
    border-radius: 15px;
    margin:0;
}

.header-title {
    font-family: 'Dancing Script', cursive;
    font-size: 3rem;
    color: #f3f1efff;
    text-shadow: 2px 2px 4px #000;
}

    </style>
</head>
<body>

<!-- Header Section -->
<header>
  <div class="text-center">
    <h1 class="header-title">Welcome to Baker Best</h1>
    <p>Freshly baked happiness, every day!</p>
    <a href="menu.php" class="btn btn-warning btn-lg mt-3">View Our Menu</a>
  </div>
</header>

<!--  Dynamic Product Section -->
<section class="container my-5">
  <h2 class="text-center mb-4">Our Fresh Arrivals </h2>
  <div class="row">
    <?php
    $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 6"; 
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '
            <div class="col-md-4 mb-4">
              <div class="card shadow-sm h-500">
                <img src="assets/images/' . htmlspecialchars($row['image']) . '" class="card-img-top" alt="' . htmlspecialchars($row['name']) . '">
                <div class="card-body text-center">
                  <h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>
                 

                </div>
              </div>
            </div>';
        }
    } else {
        echo "<p class='text-center'>No products found!</p>";
    }
    ?>
  </div>
</section>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>


 <!-- <p class="card-text fw-bold">Rs. ' . number_format($row['price'], 2) . '</p>
                  <a href="order.php?product=' . urlencode($row['name']) . '" class="btn btn-warning">Order Now</a> -->