

<?php


// Check if admin is logged in
if(!isset($_SESSION['admins'])){
    header('Location: admin_login.php');
    exit();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4b3832;">
  <div class="container">
    <!-- Logo + Name -->
    <a class="navbar-brand d-flex align-items-center" href="admin_dashboard.php" style="color: white;">
      <img src="./assets/images/logo1.png" alt="Baker Best Logo" width="95" height="60" class="me-2">
      <span style="font-family: 'Dancing Script', cursive; font-size: 1.8rem;">Admin Panel</span>
    </a>

    <!-- Mobile Toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="adminNavbar">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link text-white" href="admin_dashboard.php">Dashboard</a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white" href="add_product.php">Add Product</a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white" href="view_orders.php">Orders</a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white" href="completed_orders.php">Delivered</a>
        </li>

         <li class="nav-item">
          <a class="nav-link text-white" href="view_contacts.php">Messages</a>
        </li>

        <!-- Show username + Logout if logged in -->
        <?php if (isset($_SESSION['admins']) && !empty($_SESSION['admins'])): ?>
          <li class="nav-item ms-3 d-flex align-items-center">
            <span class="navbar-text text-white me-3">
              <?= htmlspecialchars($_SESSION['admins']) ?>
            </span>
            <a class="btn btn-danger btn-sm" href="logout.php">Logout</a>
          </li>
        <?php else: ?>
          <!-- <li class="nav-item">
            <a class="nav-link text-white" href="admin_login.php">Login</a> -->
          </li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>