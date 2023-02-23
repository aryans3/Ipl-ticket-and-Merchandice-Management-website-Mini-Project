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
    <title>ticket</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body id="ticket" style="margin: 0";>
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
        <style>
            
            body{
            background-image: url('newb.webp');
            font-family: Georgia, 'Times New Roman', Times, serif;
          }
            input{
                margin-top: 10px;
                margin-bottom: 10px;
                border-radius: 10px;
                text-align: center;
                margin-left: 30px;
                margin-right: 20px;
                padding: 8px;
            }
            #sub{
                margin-top: 10px;
                margin-bottom: 10px;
                padding: 10px 25px;
            }
            #sub:hover{
                background-color: black;
                color: white;
                transform: scale(1.1);
                transition-duration: 0.25s;
            }
            table{
                text-align: center;
            }
            #buy{
                background-color: black;
                color: white;
                border-radius: 12px;
                padding: 16px;
            }
            #buy:hover{
                background-color: greenyellow;
                color: black;
            }
            #quantity{
                max-width: 70px;
            }
            #row{
                transition-timing-function: ease-out;
                transition-duration: 0.1s;
            }
            #row:hover{
                transform: scale(1.005);
                transition-duration: 0.1s;
                box-shadow: 5px 5px 50px black;
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
        <div style="background-color: white;">
        <form action="ticket.php" method="post" >
            <input type="hidden" name="check" value="1" required>
            <input type="text" id="location" name="location" placeholder="Enter here" required>
            <button id="sub" style="border-radius: 35px;" type="submit">Search 🔎</button>
        </form>
        </div>
        <table class="table table-striped" style="background-color: white;">
            <thead>
                <tr>
                <th scope="col">Team</th>
                <th scope="col"></th>
                <th scope="col">Team</th>
                <th scope="col">Cost</th>
                <th scope="col">Location</th>
                <th scope="col">Stadium</th>
                <th scope="col">Status</th>
                <th scope="col">Time</th>
                <th scope="col">Date</th>
                <th scope="col">Quantity</th>
                <th scope="col"></th>
                </tr>
                
            </thead>
            <tbody>
                <?php
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    include 'partials/_dbconnect.php';
                    $check = $_POST["check"];
                    if($check=="1"){
                    $location = $_POST["location"];
                    $query="Select * from ticket where location='$location' or team1='$location' or team2='$location' or stadium='$location'";
                    $res = mysqli_query($conn,$query);
                    $total = mysqli_num_rows($res);
                    if($total!=0){
                        while($result=mysqli_fetch_assoc($res)){
                           ?> <tr id="row"><?php echo"
                                    <td><img src=".$result['img1']." height=50px width=65px></td>
                                    <td>VS</td>
                                    <td><img src=".$result['img2']." height=50px width=65px></td>
                                    <td>Rs ".$result['cost']."</td>
                                    <td>".$result['location']."</td>
                                    <td>".$result['stadium']."</td>
                                    <td>".$result['status']."</td>
                                    <td>".$result['time']."</td>
                                    <td>".$result['date']."</td>";?>
                                    <form action="transaction.php" method="POST">
                                    <td><input id="quantity" name="quantity" type="number" min="1" max="10" required></td>
                                    <input type="hidden" name="check" value="0" required>
                                    <input type="hidden" name="img1" value="<?php echo $result['img1'] ?>" required>
                                    <input type="hidden" name="img2" value="<?php echo $result['img2'] ?>" required>
                                    <input type="hidden" name="cost" value="<?php echo $result['cost'] ?>" required>
                                    <input type="hidden" name="date" value="<?php echo $result['date'] ?>" required>
                                    <input type="hidden" name="location" value="<?php echo $result['location'] ?>" required>
                                    <input type="hidden" name="time" value="<?php echo $result['time'] ?>" required>
                                    <input type="hidden" name="stadium" value="<?php echo $result['stadium'] ?>" required>
                                    <td><button id="buy" type="submit">BUY</button></td>
                                    </form>
                                <?php echo "</tr>";
                        }
                    }
                }
                }
                else{
                include 'partials/_dbconnect.php';
                $query = "Select * from ticket";
                $res = mysqli_query($conn,$query);
                $total = mysqli_num_rows($res);
                if($total!=0){
                    while($result=mysqli_fetch_assoc($res)){
                        ?> <tr id="row"><?php echo"
                                <td><img src=".$result['img1']." height=50px width=65px></td>
                                <td>VS</td>
                                <td><img src=".$result['img2']." height=50px width=65px></td>
                                <td>Rs ".$result['cost']."</td>
                                <td>".$result['location']."</td>
                                <td>".$result['stadium']."</td>
                                <td>".$result['status']."</td>
                                <td>".$result['time']."</td>
                                <td>".$result['date']."</td>";?>
                                    <form action="transaction.php" method="POST">
                                    <td><input id="quantity" name="quantity" type="number" min="1" max="10"  required></td>
                                    <input type="hidden" name="check" value="0" required>
                                    <input type="hidden" name="img1" value="<?php echo $result['img1'] ?>" required>
                                    <input type="hidden" name="img2" value="<?php echo $result['img2'] ?>" required>
                                    <input type="hidden" name="cost" value="<?php echo $result['cost'] ?>" required>
                                    <input type="hidden" name="date" value="<?php echo $result['date'] ?>" required>
                                    <input type="hidden" name="location" value="<?php echo $result['location'] ?>" required>
                                    <input type="hidden" name="time" value="<?php echo $result['time']?>" required>
                                    <input type="hidden" name="stadium" value="<?php echo $result['stadium'] ?>" required>
                                    <td><button id="buy" type="submit">BUY</button></td>
                                    </form>
                                <?php echo "</tr>";
                        }
                    }
                }
                ?>
            </tbody>
        </table>
        
</body>
</html>