<?php
$server = "localhost";
$username = "root";
$password ="";
$database="users";
$conn = mysqli_connect($server,$username,$password,$database);
if(!$conn){// agar connection nahi ho paye toh
    die("error".mysqli_connect_error());
}
?>