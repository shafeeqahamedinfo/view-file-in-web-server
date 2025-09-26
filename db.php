<?php
$host = "localhost";
$user = "root";   // change if needed
$pass = "";       // change if password exists
$dbname = "file_upload_demo";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>