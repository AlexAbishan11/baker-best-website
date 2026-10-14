<?php
include('navbar.php'); 
include('config/dbconnect.php'); // connect to your DB
?>

<?php
if(isset($_GET['order']) && $_GET['order'] === 'success'){
    echo "<div class='alert alert-success text-center my-3'>
            Your order has been placed successfully!
          </div>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu | Baker Best</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body class="menu-page">

<div class="container my-5">
    <h2 class="text-center mb-4">Menu</h2>
    <div class="row">
        <?php
        $sql = "SELECT * FROM products ORDER BY id DESC";
        $result = $conn->query($sql);

        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo '<div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <img src="assets/images/'.$row['image'].'" class="card-img-top" alt="'.htmlspecialchars($row['name']).'">
                            <div class="card-body text-center">
                                <h5 class="card-title">'.htmlspecialchars($row['name']).'</h5>
                                <p class="card-text">RS '.number_format($row['price'],2).'/=</p>
                                <a href="order.php?product='.urlencode($row['name']).'" class="btn btn-warning">Order Now</a>
                            </div>
                        </div>
                    </div>';
            }
        } else {
            echo "<p class='text-center'>No products available.</p>";
        }
        ?>
    </div>
</div>


<?php include('footer.php'); ?> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
