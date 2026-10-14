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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Contacts | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Admin add product  heading */
/* .admin-heading {
    color: #faf4f4ff;          
    background-color:#4b3832; 
    padding: 15px;
    border-radius: 10px;
    font-family: 'Dancing Script', cursive;/* Optional stylish font 
    
} */
body {
            background-image: url('./assets/images/admin_bg.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
.table-custom thead th {
    background-color:  #4b3832; !important;
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
        padding: 15px 90px;
        border-radius: 15px;
        font-family: 'Dancing Script', cursive;
        margin: 10;
        ">Contact Messages</h2>
    <?php
    $sql = "SELECT * FROM contacts ORDER BY id DESC";
    $result = $conn->query($sql);

    if($result && $result->num_rows>0){
        echo '<div class="table-responsive">
                <table class="table table-bordered table-striped table-custom text-center">
                    <thead>
                        <tr>
                            
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date Sent</th>
                        </tr>
                    </thead>
                    <tbody>';
        while($row = $result->fetch_assoc()){
            echo '<tr>
                    
                    <td>'.$row['name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['message'].'</td>
                    <td>'.$row['date_sent'].'</td>
                  </tr>';
        }
        echo '</tbody></table></div>';
    } else { echo "<div class='alert alert-info text-center'>No contact messages found.</div>"; }
    ?>
</div>
</body>
</html>
<!-- 49 <th>ID</th> -->
 <!-- <td>'.$row['id'].'</td> -->