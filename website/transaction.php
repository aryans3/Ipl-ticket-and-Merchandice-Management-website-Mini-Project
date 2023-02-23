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
    <title>Transaction Page</title>
    <link rel="stylesheet" href="style.css">
  <script src="merch.js"></script>
</head>
<body id="t" style="margin:0";>
<video id="bgvideo" autoplay muted loop>
        <source src="tv.webm" type="video/mp4">
</video>
<style>
    #bgvideo {
  position: fixed;
  right: 0;
  bottom: 0;
  width: 100%; 
  min-height: 100%;
  z-index: -1;
}
    body{
    font-family: 'Times New Roman', Times, serif;
    }
    #trans{
    border-radius: 35px;
    max-width: 600px;
    margin: auto;
    margin-top: 100px;
    backdrop-filter: blur(10px);
    background-color: rgba(0, 0, 0, 0.168);
    padding: 50px;
    color: white;
}
.container h1{
    text-align: center;
}

#trans img{
    height: 40px;
    width: 62px;
}
#confirm{
    padding: 10px;
    margin-left: 0px;
    width: 100%;
    color: white;
    background-color: blue;
}
#confirm:hover{
    transform: scale(1.05);
    transition-duration: 0.3s;
}
.first-row,.second-row{
    display: flex;
}

.owner,.card-number{
   margin-right: 40px;
}

.input-field,.num,.cvv{
   border: 1px solid #999;
   border-radius: 12px;
}

.input-field input{
    width: 260px;
   border:none;
   padding: 10px;
   border-radius: 12px;
}
.num input{
    width: 420px;
   border:none;
   padding: 10px;
   border-radius: 12px;
}
.cvv input{
    width: 100px;
   border:none;
   padding: 10px;
   border-radius: 12px;
}
.selection{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 50px;
   border-radius: 12px;
}

.selection input{
    padding: 10px 20px;
    font-size: 110%;
   border-radius: 12px;

}

.cards img{
    width: 100px;
}
</style>

        <?php
            if($_SERVER["REQUEST_METHOD"]=="POST"){
            include 'partials/_dbconnect.php';
            $check = $_POST["check"];
            if($check=="0"){
            $_SESSION["quantity"]= $_POST["quantity"];
            $_SESSION["img1"]= $_POST["img1"];
            $_SESSION["img2"] = $_POST["img2"];
            $_SESSION["cost"] = $_POST["cost"];
            $_SESSION["location"] = $_POST["location"];
            $_SESSION["date"]= $_POST["date"];
            $_SESSION["time"]= $_POST["time"];
            $_SESSION["stadium"]= $_POST["stadium"];
            ?>

            <form id="trans" action="transaction.php" method="post">
            <div class="container">
            <h1>Confirm Your Payment</h1>
            <div class="first-row">
                <div class="owner">
                    <h3>First Name</h3>
                    <div class="input-field">
                        <input name="first_name" type="text" placeholder="First Name" required>
                        <input type="hidden" name="check" value="1" required>
                    </div>
                </div>

                <div class="owner">
                    <h3>Last Name</h3>
                    <div class="input-field">
                        <input name="last_name" type="text" placeholder="Last Name" required>
                    </div>
                </div>
            </div>
            <div class="second-row">
                <div class="card-number">
                    <h3>Card Number</h3>
                    <div class="num">
                        <input name="card_num" type="password" placeholder="xxxx-xxxx-xxxx-xxxx" required>
                    </div>
                </div>

                <div>
                    <h3>CVV</h3>
                    <div class="cvv">
                        <input name="cvv" type="password" placeholder="***" required>
                    </div>
                </div>
            </div>
            <div class="third-row">
                <h3>Expiry Month</h3>
                <div class="selection">
                    <div class="date">
                        <input type="date" required>
                    </div>
                    <div class="cards">
                        <img src="mc.png" alt="">
                        <img src="vi.png" alt="">
                        <img src="pp.png" alt="">
                    </div>
                </div>    
            </div>
            <button id="confirm" type="submit">CONFIRM</button>
            </div>
            </form>
            <?php
            }

            else if($check=="1"){
                $first_name = $_POST["first_name"];
                $last_name = $_POST["last_name"];//stores the password we give
                $card_num = $_POST["card_num"];
                $cvv = $_POST["cvv"];
                $sql="Select * from bank where first_name ='$first_name' AND last_name='$last_name' AND card_num = '$card_num' AND cvv = '$cvv'";//runs the query and finds out all the entries which have same username and password
        
                $result = mysqli_query($conn,$sql);// performs the query if it fails to do so returns die
                $num = mysqli_num_rows($result);
                if($num!=0){
                    $quantity = $_SESSION['quantity'];
                    $username = $_SESSION['username'];
                    $img1 = $_SESSION["img1"];
                    $img2 = $_SESSION["img2"];
                    $cost = $_SESSION["cost"];
                    $location = $_SESSION["location"];
                    $date= $_SESSION["date"];
                    $time = $_SESSION["time"];
                    $stadium = $_SESSION["stadium"];
                    $totalcost=$_SESSION['quantity']*$_SESSION["cost"];
                    $sql="INSERT INTO `ticorders` (`user`,`img1`,`img2`,`quantity`,`cost`,`Location`,`date`,`time`,`stadium`) VALUES ('$username','$img1','$img2','$quantity','$totalcost','$location','$date','$time','$stadium')";
                    $result = mysqli_query($conn,$sql);
                    header("location: yourtic.php");
                }
                else{
                    echo "TRANSACTION FAILED";
                }
            }
}
else{
    ?>
    <form id="trans" action="addcart.php" method="post">
            <div class="container">
            <h1>Confirm Your Payment</h1>
            <div class="first-row">
                <div class="owner">
                    <h3>First Name</h3>
                    <div class="input-field">
                        <input name="first_name" type="text" placeholder="First Name" required>
                    </div>
                </div>

                <div class="owner">
                    <h3>Last Name</h3>
                    <div class="input-field">
                        <input name="last_name" type="text" placeholder="Last Name" required>
                    </div>
                </div>
            </div>
            <div class="second-row">
                <div class="card-number">
                    <h3>Card Number</h3>
                    <div class="num">
                        <input name="card_num" type="password" placeholder="xxxx-xxxx-xxxx-xxxx" required>
                    </div>
                </div>

                <div>
                    <h3>CVV</h3>
                    <div class="cvv">
                        <input name="cvv" type="password" placeholder="***" required>
                    </div>
                </div>
            </div>
            <div class="third-row">
                <h3>Expiry Month</h3>
                <div class="selection">
                    <div class="date">
                        <input type="date" required>
                    </div>
                    <div class="cards">
                        <img src="mc.png" alt="">
                        <img src="vi.png" alt="">
                        <img src="pp.png" alt="">
                    </div>
                </div>    
            </div>
            <button id="confirm" type="submit">CONFIRM</button>
            </div>
            </form>
            <?php
}
    ?>
</body>
</html>