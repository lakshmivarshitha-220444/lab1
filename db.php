<?php
$conn=mysqli_connect("localhost","root","","testdb");

if(!$conn){
    die("database connection failed");
}
echo "database connected successfully";
?>