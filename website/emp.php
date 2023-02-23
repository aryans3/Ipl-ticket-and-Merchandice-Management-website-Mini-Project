<?php
  $login = false;
  $showerror = false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
      include 'partials/_dbconnect.php';
      $empid = $_POST["id"];
      $password = $_POST["password"];
      $sql="Select * from emp where empid='$empid' AND password='$password'";
        $result = mysqli_query($conn,$sql);
        $num = mysqli_num_rows($result);
      if($num==1){
        $login = true;
        session_start();
        $_SESSION['empid']=$empid;
        $_SESSION['loggedin']=true;
        header("location: mainemp.php");
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
   if($showerror){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Failed!!</strong> Account doesnt exist.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
   }
   ?> 
    <div class="center">
      <h1>Employee Log In</h1>
      <form action="emp.php" method="post">
        <div class="txt_field">
        <label for="username">Employee ID</label>
          <input type="text" id="username" name="id" required>
        </div>
        <div class="txt_field">
        <label for="password">Password</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div id="submit">
          <button id="sub" type="submit">Log In</button>
        </div>
      </form>
    </div>
  </body>
</html>