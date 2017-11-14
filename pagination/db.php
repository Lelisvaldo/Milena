<?php
$servername = "localhost";
$username = "sa";
$password = "123";
$dbname = "u869855761_bdibl";
$limit = 5;

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} 
?> 
