<?php 
session_start();
session_unset();
session_destroy();
header("location: index.php");//basically session se bahar nikal raha hai by destroying session and redirecting
?>