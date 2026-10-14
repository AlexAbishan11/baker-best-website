<?php
$servername = "localhost";
$username = "root"; // default for WAMP
$password = "root"; // default for WAMP
$database = "bakerbest_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
