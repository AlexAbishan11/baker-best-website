<?php
include('config/dbconnect.php'); // DB connection
include('navbar.php'); // Common navbar
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us | Baker Best</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link href="assets/css/style.css" rel="stylesheet">
    <style>
/* h2{
    font-family: 'Dancing Script', cursive;
    background-color:#5c4033;
    color: #ffffffff;
    padding: 15px;
    border-radius: 15px;
    margin:0;
} */
    </style>
</head>
<body class="contact-page">

<div class="container my-5">
    <div style="text-align: center;"> 
    <h2 style="
        display: inline-block;
        background-color: #5c4033;
        color: white;
        padding: 15px 225px;
        border-radius: 15px;
        font-family: 'Dancing Script', cursive;
        margin: 15;
        ">Contact Us</h2>
</div>

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
            <label for="message" class="form-label">Message</label>
            <textarea name="message" id="message" class="form-control" rows="5" placeholder="Write your message..." required></textarea>
        </div>

        <div class="text-center">
        <button type="submit" name="submit" class="btn btn-warning fw-bold px-4 py-2">Send Message</button>
        </div>
   </form>

<!-- Google Map -->
<<div style="text-align: center;">
    <h3 style="
        display: inline-block;
        background-color: #5c4033;
        color: white;
        padding: 15px 225px;
        border-radius: 15px;
        font-family: 'Dancing Script', cursive;
        margin: 15px 0;
    ">
        Our location
    </h3>
</div>

    <div class="map-container shadow" style="border-radius: 15px; overflow: hidden;">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3930.218873334302!2d80.01853637481048!3d9.661498590436505!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3afe5526e6bf9df5%3A0x41bd50a0c0cc52f1!2sJaffna%20Town!5e0!3m2!1sen!2slk!4v1703249845693!5m2!1sen!2slk"
            width="100%" 
            height="350" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>

<?php
if(isset($_POST['submit'])){

        // Escape input values
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $message = $conn->real_escape_string($_POST['message']);

        // Insert into contacts table
        $sql = "INSERT INTO contacts (name, email, message, date_sent) 
                VALUES ('$name', '$email', '$message', CURDATE())";

        if($conn->query($sql) === TRUE){
            echo "<div class='alert alert-success text-center mt-4'>
                    Your message has been sent successfully!
                  </div>";
            // Optional: reset form
            echo "<script>document.querySelector('form').reset();</script>";
        } else {
            echo "<div class='alert alert-danger text-center mt-4'>
                    Error: " . $conn->error . "
                  </div>";
        }
    }

    $conn->close();
    ?>
</div>

<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
