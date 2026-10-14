<?php
// Get current page filename
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <!-- <a class="navbar-brand" href="index.php">🍞 Baker Best</a> -->

    <a class="navbar-brand d-flex align-items-center" href="index.php">
  <img src="assets\images\logo1.png" alt="Baker Best Logo" width="95" height="60" class="me-2">
  Baker Best
</a>


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?php echo ($currentPage == 'index.php') ? 'active' : ''; ?>" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($currentPage == 'about.php') ? 'active' : ''; ?>" href="about.php">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($currentPage == 'menu.php') ? 'active' : ''; ?>" href="menu.php">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($currentPage == 'order.php') ? 'active' : ''; ?>" href="order.php">Order Online</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($currentPage == 'contact.php') ? 'active' : ''; ?>" href="contact.php">Contact Us |</a>
        </li>
      </ul>

      
      <ul class="navbar-nav ms-3">
        <li class="nav-item">
          <a class="nav-link" href="https://facebook.com/" target="_blank">
            <i class="bi bi-facebook"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://instagram.com/" target="_blank">
            <i class="bi bi-instagram"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://tiktok.com/" target="_blank">
            <i class="bi bi-tiktok"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://x.com/" target="_blank">
            <i class="bi bi-twitter-x"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://youtube.com/" target="_blank">
            <i class="bi bi-youtube"></i>
          </a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
