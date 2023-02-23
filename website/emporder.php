<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPL</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
</head>
<body style="margin:0";>
<style>
    body{
        background: none;
    }
    table{
        width: 1100px;
        height: 250px;
    }
    .cart{
        background-color: white;
        margin: auto;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    }
    tbody{
        background: rgb(207, 207, 207);
    }
    tr{
        transition-duration: 0.2s;
        transition-timing-function: ease-in-out;
    }
    tr:hover{
        transform: scale(1.002);
        transition-duration: 0.2s;
        box-shadow: 5px 5px 40px black;
    }
    #search{
        border-radius: 12px;
        padding: 10px;
    }
    #sub{
        padding: 15px;
        margin-left: 30px;
    }
    #sub:hover{
        transform: scale(1);
        color: white;
        background: black;
    }
    .navbar a:hover{
                    text-decoration: none;
                    color: black;
    padding: 12px;
    background-color: white;
    border-radius: 14px;
  }
  #main:hover{
    padding: 0px;
    background:none;
  }
</style>
        <header style="z-index: 1;background:black;" >
            <nav class="navbar">
                <a id="main" href="main.php"><img id="ipllogo" src="ipllogo.png"></a>
                <div id="hi">
                <a href="mainemp.php">Stats</a>
                <a href="empuser.php">User</a>
                <a href="emptic.php">Tickets</a>
                <a href="emptrans.php">Finances</a>
                <a href="emporder.php">Orders</a>
                <a href="logout.php">Log Out</a>
                </div>
            </nav>
        </header>
        
        <div class="cart">
        <div class="row no-gutters">
            <div class="col-md-8" style="margin-left: 250px;">
                <div class="product-details mr-2">
            <br> <h6 class="mb-0" style="font-size: x-large; text-align:center;"><b>Order History</h6>
                    <hr>
                </div>
            <br>

                <form action="emporder.php" method="post" style="text-align: center;" >
            <input type="text" id="search" name="username" placeholder="Enter username" required>
            <button id="sub" style="border-radius: 35px;" type="submit">Search 🔎</button>
        </form>
        <br>

                <table class="table">
                <thead class="thead-dark">
                <tr>
                <th scope="col">User</th>
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
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $username = $_POST["username"];
                    $query="Select * from orders where username='$username'";
                    $res = mysqli_query($conn,$query);
                    while($result=mysqli_fetch_assoc($res)){
                        echo"<tr>
                                <td>".$result['username']."</td>
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
                }
                else{
                    $query="Select * from orders";
                    $res = mysqli_query($conn,$query);
                        while($result=mysqli_fetch_assoc($res)){
                            echo"<tr>
                                    <td>".$result['username']."</td>
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
                    }
                ?>
            </tbody>
                </table>
            </div>
            </div>
            </div>
</body>
</html>