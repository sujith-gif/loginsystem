<?php
$servername = "localhost";
$username = "sujith";
$password = "123";
$dbname = "sujith";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>