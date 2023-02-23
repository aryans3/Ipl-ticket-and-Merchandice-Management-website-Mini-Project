<?php
  $showalert = false;
  $showerror = false;

if($_SERVER["REQUEST_METHOD"]=="POST"){
      include 'partials/_dbconnect.php';
      $username = $_POST["username"];
      $password = $_POST["password"];
      $cpassword = $_POST["cpassword"];

      $check="Select * from users where username='$username'";
      $result = mysqli_query($conn,$check);//runs query
      $num = mysqli_num_rows($result);//gives the number of rows

    if($password==$cpassword && $num==0){//check ki same name wale entries nahi hai
        $sql="INSERT INTO `users` (`username`, `password`, `dt`) VALUES ( '$username', '$password', current_timestamp())";// create query
        $result = mysqli_query($conn,$sql);//run query
      if($result){
        $showalert = true;
        header("location: index.php");
      }
    }
    else{
      $showerror = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="log.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <style>
    body{
  background-image: url('newb.webp');
  background-size: cover;
  height: 100vh;
  overflow: hidden;
}
    </style>
   <?php
   if($showalert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!!</strong> Account Created.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
   }
   if($showerror){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Failed!!</strong> Account Not Created wrong password Or Username not Available.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
   }
   ?>  

    <div class="center">
      <h1>Sign Up</h1>
      <form action="signin.php" method="post">
        <div class="txt_field">
        <label for="username">Username</label>
          <input type="text" id="username" name="username" required>
        </div>
        <div class="txt_field">
        <label for="password">Password</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div class="txt_field">
        <label for="cpassword">Confirm Password</label>
          <input type="password" id="cpassword" name="cpassword" required>
        </div>
        <div id="submit">
          <button id="sub" type="submit">Sign Up</button>
        </div>
      </form>
    </div>
  </body>
</html>