<?php
session_start();
include('./config/dbconnect.php');

// Debug session at start
error_log("Login page loaded. Session: " . print_r($_SESSION, true));

// Handle login form submission FIRST
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    // Validate inputs
    if(empty($username) || empty($password)){
        $error = "Please enter both username and password.";
    } else {
        // Prepare statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT username, password FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        
        if($stmt->num_rows == 1){
            $stmt->bind_result($db_username, $db_password);
            $stmt->fetch();
            
            // Check plain text password
            if($password === $db_password){
                $_SESSION['admins'] = $username;
                error_log("Login successful. Session set: " . $_SESSION['admins']);
                header('Location: admin_dashboard.php');
                exit();
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid username or password.";
        }
        $stmt->close();
    }
}

// Check if already logged in AFTER handling POST
if(isset($_SESSION['admins'])){
    error_log("Already logged in, redirecting to dashboard");
    header('Location: admin_dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Baker Best</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('./assets/images/admin_bg.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .admin-login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background: #5c4033;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.5);
            text-align: center;
        }
        .admin-login-container h2 {
            font-family: 'Dancing Script', cursive;
            color: #f7f7f7ff;
            margin-bottom: 15px;
            /* background: white; */
            border-radius: 10px;
        }
        .admin-logo img {
            width: 105px;
            height: 70px;
            margin-bottom: 15px;
        }
        .form-label {
            color: #f3f1f1ff;
            font-weight: bold;
            text-align: left;
            display: block;
        }
        .form-control {
            background-color: #fcfbfbff;
            color: #110202ff;
            border: none;
            border-radius: 6px;
            padding: 10px;
        }
        .form-control::placeholder {
            color: #110101ff;
        }
        .btn-success {
            background-color: #137c48;
            border: none;
            border-radius: 6px;
            font-weight: bold;
        }
        .btn-success:hover {
            background-color: #0e5f38;
        }
    </style>
</head>
<body>
<div class="admin-login-container">
    <h2>Admin Login</h2>

    <div class="admin-logo">
        <img src="./assets/images/logo1.png" alt="Baker Best Logo" class="me-2">
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" class="login-form">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter username" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>

        <button type="submit" name="login" class="btn btn-success w-100">Login</button>
    </form>
</div>
</body>
</html>