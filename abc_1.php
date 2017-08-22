<?php
$servername = "localhost";
$username = "root";
$password = "3535";
$dbname = "blog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql ="";
if ($conn->query($sql) === TRUE) {
    echo "Successfully";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>


