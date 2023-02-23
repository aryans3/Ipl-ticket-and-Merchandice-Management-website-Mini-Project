<?php
session_start();//this method will check if session exists agar exist nahi karta hai then it will redirect u to log in
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body style="margin: 0";>
<style>
    body{
            background-image: url('newb.webp');
          }
    .cart{
        background-color: white;
        padding: 36px;
        max-width: 1100px;
        margin: auto;
        border-radius: 50px;
        margin-top: 50px;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    }
    table{
        width: 1100px;
        height: 250px;
    }
    .navbar a:hover{
                    text-decoration: none;
                    color: white;
    padding: 12px;
    background-color: orange;
    border-radius: 14px;
  }
  #main:hover{
    padding: 0px;
    background:none;
  }
</style>
<header  style="z-index: 1;" >
            <nav class="navbar">
                <a id="main" href="main.php"><img id="ipllogo" src="ipllogo.png"></a>
                <div id="hi">
                <a href="main.php">Stats</a>
                <a href="ticket.php">Buy Tickets</a>
                <a href="merch.php">Buy Merchandise</a>
                <a href="addcart.php">Your Cart</a>
                <a href="yourtic.php">My Tickets</a>
                <a href="order.php">Order History</a>
                <a href="logout.php">Log Out</a>
                </div>
            </nav>
        </header>

        <div class="cart">
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="product-details mr-2">
                    <h6 class="mb-0" style="font-size: x-large;"><b>Order List</h6>
                    <hr>
                </div>
                <table>
                <thead>
                <tr>
                <th scope="col">Item</th>
                <th scope="col">Quantity</th>
                <th scope="col">Cost</th>
                <th scope="col">Placed On</th>
                <th scope="col">Transaction Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    include 'partials/_dbconnect.php';
                    $username = $_SESSION['username'];
                    $query="Select * from orders where username='$username'";
                    $res = mysqli_query($conn,$query);
                        while($result=mysqli_fetch_assoc($res)){
                            echo"<tr>
                                    <td>".$result['kit']." kit</td>
                                    <td>".$result['quantity']."</td>
                                    <td>Rs ".$result['cost']."</td>
                                    <td>".$result['date']."</td>
                                    ";?>
                                    <td style="text-align: center;">
                                    <?php echo $result['status']?>
                                    </td>
                                    <?php
                               echo "</tr>";
                        }
                ?>
            </tbody>
                </table>
            </div>
            </div>
            </div>
            <button onclick="window.print()" style="margin-left: 700px; margin-top: 50px; border-radius:15px" >PRINT</button>
</body>
</html>