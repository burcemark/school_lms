<?php
$conn = new mysqli("localhost","root","","compet");

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
?>