<?php
$servername = "localhost";
$username = "root";
$password = ""; // if you have set a password, replace the empty string with your password
$dbname = "crud";
$submit = false;
$notsubmit = false;
$emailis = false;


// Create connection
$conn = new mysqli($servername, $username, $password,$dbname,3308);

// Check connection
if ($conn->connect_error) {
    die("Connection failed ritam: " . $conn->connect_error);
}
?>