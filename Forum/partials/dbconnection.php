<?php
// connecting to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "iforum";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    echo ("error");
} else {
    "success";
}
