<?php
session_start();//this method will check if session exists agar exist nahi karta hai then it will redirect u to log in
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit;
}
?>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'partials/_dbconnect.php';
    $username = $_SESSION['username'];
    $img = $_POST["img"];
    $kit = $_POST["kit"];
    $cost = $_POST["cost"];
    $quantity = $_POST["quantity"];
    $sql="INSERT INTO `merch` (`username`,`img`, `kit`,`quantity`, `cost`) VALUES ('$username','$img','$kit','$quantity','$cost')";
    $result = mysqli_query($conn,$sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchandise</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="margin:0";>

    <header  style="z-index: 1;" >
        <nav class="navbar">
            <a id="main" href="main.php"><img id="ipllogo" src="ipllogo.png"></a>
            <div id="hi">
            <a href="main.php">Stats</a>
            <a href="ticket.php">Buy Tickets</a>
            <a href="merch.php">Buy Merchandise</a>
            <a href="yourtic.php">My Tickets</a>
            <a href="addcart.php">Your Cart</a>
            <a href="order.php">Order History</a>
            <a href="logout.php">Log Out</a>
            </div>
        </nav>
    </header>
    <style>
        .card{
            color: black;
            box-shadow: 5px 5px 35px black;
            font-family: "Century Gothic";
        }
        #addc img{
            height: 50px;
        }
        .card{
            z-index: -1;
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
    
    <section id="merch">
            <div class="card" id="mi" style="width: 18rem;" data-aos="flip-right">
            <img id="imgclick1" src="mi1.png">
            <div class="inner">
                <h5 class="card-title">Mumbai Indians Kit</h5>
                <h1 id="cost">Rs 1900</h1>
                <form id="f1" action="merch.php" method="post">
                <input type="hidden" name="kit" value="Mumbai Indians" required>
                <input type="hidden" name="quantity" value="1" required>
                <input type="hidden" name="cost" value="1900" required>
                <input type="hidden" name="img" value="mi1.png" required> 
                <div onclick="document.getElementById('f1').submit();" id="addc">  
                <img src="ac.png">
                </div>
                </form>
            </div>
            </div>
        
        <div class="card" id="rcb" style="width: 18rem;" data-aos="flip-right">
        <img src="rcb1.png">
        <div class="inner">
            <h5 class="card-title">Royal Chalengers Bangalore Kit</h5>
            <h1 id="cost">Rs 1900</h1>
        <form id="f2" action="merch.php" method="post">
            <input type="hidden" name="kit" value="Royal Chalengers Bangalore" required>
            <input type="hidden" name="quantity" value="1" required>
            <input type="hidden" name="cost" value="1900" required>
            <input type="hidden" name="img" value="rcb1.png" required>
            <div onclick="document.getElementById('f2').submit();" id="addc">  
                <img src="ac.png">
                </div>
        </form>
        </div>
        </div>
        
        <div class="card" id="csk" style="width: 18rem;" data-aos="flip-right">
        <img src="csk1.png">
        <div class="inner">
            <h5 class="card-title">Chennai Super Kings Kit</h5>
            <h1 id="cost">Rs 1900</h1>
        <form id="f3" action="merch.php" method="post">
            <input type="hidden" name="kit" value="Chennai Super Kings" required>
            <input type="hidden" name="quantity" value="1" required>
            <input type="hidden" name="cost" value="1900" required>
            <input type="hidden" name="img" value="csk1.png" required>
            <div onclick="document.getElementById('f3').submit();" id="addc">  
                <img src="ac.png">
                </div>
        </form>
        </div>
        </div>
        
        <div class="card" id="rr" style="width: 18rem;" data-aos="flip-right">
        <img src="rr1.png">
        <div class="inner">
            <h5 class="card-title">Rajasthan Royals Kit</h5>
            <h1 id="cost">Rs 1900</h1>
        <form id="f4" action="merch.php" method="post">
            <input type="hidden" name="kit" value="Rajasthan Royals" required>
             <input type="hidden" name="quantity" value="1" required>
            <input type="hidden" name="cost" value="1900" required>
            <input type="hidden" name="img" value="rr1.png" required>
            <div onclick="document.getElementById('f4').submit();" id="addc">  
                <img src="ac.png">
                </div>
        </form>
        </div>
        </div>

        <div class="card" id="kkr" style="width: 18rem;" data-aos="flip-right">
        <img src="kkr1.png">
        <div class="inner">
            <h5 class="card-title">Kolkata Knight Riders Kit</h5>
            <h1 id="cost">Rs 1900</h1>
        <form id="f5" action="merch.php" method="post">
            <input type="hidden" name="kit" value="Kolkata Knight Riders" required>
            <input type="hidden" name="quantity" value="1" required>
            <input type="hidden" name="cost" value="1900" required>
            <input type="hidden" name="img" value="kkr1.png" required>
            <div onclick="document.getElementById('f5').submit();" id="addc">  
                <img src="ac.png">
                </div>
        </form>
        </div>
        </div>

        <div class="card" id="pjb" style="width: 18rem;" data-aos="flip-right">
        <img src="pjb1.png">
        <div class="inner">
            <h5 class="card-title">KXIP Kit</h5>
            <h1 id="cost">Rs 1900</h1>
        <form id="f6" action="merch.php" method="post">
            <input type="hidden" name="kit" value="KXIP" required>
             <input type="hidden" name="quantity" value="1" required>
            <input type="hidden" name="cost" value="1900" required>
            <input type="hidden" name="img" value="pjb1.png" required>
            <div onclick="document.getElementById('f6').submit();" id="addc">  
                <img src="ac.png">
                </div>
        </form>
        </div>
        </div>

    </section>
</body>
</html>