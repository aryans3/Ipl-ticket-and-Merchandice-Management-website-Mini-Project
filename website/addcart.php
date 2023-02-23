<?php
session_start();//this method will check if session exists agar exist nahi karta hai then it will redirect u to log in
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit;
}
?>

<?php
//method to copy data from merch to order after placing order
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include 'partials/_dbconnect.php';

        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];//stores the password we give
        $card_num = $_POST["card_num"];
        $cvv = $_POST["cvv"];
        
        $sql="Select * from bank where first_name ='$first_name' AND last_name='$last_name' AND card_num = '$card_num' AND cvv = '$cvv'";//runs the query and finds out all the entries which have same username and password

        $result = mysqli_query($conn,$sql);// performs the query if it fails to do so returns die
        $num = mysqli_num_rows($result);
        $username = $_SESSION['username'];

        if($num!=0){
                $query="Select kit,SUM(quantity),SUM(cost) from merch where username='$username' group by kit";
                $res = mysqli_query($conn,$query);
            while($result=mysqli_fetch_assoc($res)){
                $kit = $result['kit'];
                $quantity = $result['SUM(quantity)'];
                $cost= $result['SUM(cost)'];
                $query1="INSERT INTO `orders` (`username`,`kit`,`quantity`,`cost`,`date`,`status`) VALUES ( '$username', '$kit','$quantity','$cost', current_timestamp(),'✅')";
                $result1 = mysqli_query($conn,$query1);
            }
            $query2="DELETE FROM merch where username='$username';";
            $result2 = mysqli_query($conn,$query2);
            header("location: order.php");
        }
        else{
            $query="Select kit,SUM(quantity),SUM(cost) from merch where username='$username' group by kit";
        $res = mysqli_query($conn,$query);
        while($result=mysqli_fetch_assoc($res)){
            $kit = $result['kit'];
            $quantity = $result['SUM(quantity)'];
            $cost= $result['SUM(cost)'];
            $query1="INSERT INTO `orders` (`username`,`kit`,`quantity`,`cost`,`date`,`status`) VALUES ( '$username', '$kit','$quantity','$cost', current_timestamp(),'❌')";
            $result1 = mysqli_query($conn,$query1);
        }
        $query2="DELETE FROM merch where username='$username';";
        $result2 = mysqli_query($conn,$query2);
        header("location: order.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body style="margin: 0;">
<style>
    *{
        font-family: Georgia, 'Times New Roman', Times, serif;
    }
    img{
        width: 100px;
        height: 100px;
    }
   
    table{
        width: 800px;
        height: 300px;
    }
    #box{
        max-width: 800px;
        background-color: white;
        border-radius: 25px;
        margin: auto;
    }
    #plus,#minus{
        background: none;
        font-size: large;
        padding: 0px;
        transition-duration: 0.1s;
        transition-timing-function: ease-in-out;
    }
    #plus{
        padding: 8px;
        margin-right: 15px;
    }
    #minus{
        padding: 8px;
        margin-left: 15px;
    }
    #plus:hover,#minus:hover{
        transform: scale(1.5);
        transition-duration: 0.1s;
    }
    #c1,#c2,#c3{
        display: inline-block;
    }
    #bin{
        background: none;
        padding: 0px;
    }
    #bin img{
        width: 30px;
        height: 30px;
        background: none;
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
                        
    <section id="box" class="pt-5 pb-5">
  <div class="container">
    <div class="row w-100">
        <div class="col-lg-12 col-md-12 col-12">
            <h3 class="display-5 mb-2 text-center">Shopping Cart</h3>
            <hr>
            <p class="mb-5 text-center">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include 'partials/_dbconnect.php';
                        $username = $_SESSION['username'];
                        $query="Select img,kit,SUM(quantity),SUM(cost) from merch where username='$username' group by kit";
                        $res = mysqli_query($conn,$query);
                            while($result=mysqli_fetch_assoc($res)){
                                echo"<tr>";?>
                                        <td>
                                        <form action="change.php" method="post">
                                        <input type="hidden" name="flag" value="2" required>
                                        <input type="hidden" name="product" value="<?php echo $result['kit'] ?>" required>
                                        <button type="submit" id="bin"><img src="send-to-trash-removebg-preview.png"></button>
                                        </form>
                                        </td>
                                        <?php echo "<td><img src=".$result['img']." height=50px width=65px></td>
                                        <td>".$result['kit']."</td>";?>
                                        <td>
                                        <form action="change.php" method="post" id="c1">
                                        <input type="hidden" name="flag" value="1" required>
                                        <input type="hidden" name="img" value="<?php echo $result['img'] ?>" required>
                                        <input type="hidden" name="product" value="<?php echo $result['kit'] ?>" required>
                                        <input type="hidden" name="quantity" value="1" required>
                                        <input type="hidden" name="cost" value="1900" required>
                                        <button type="submit" id="plus">+</button>
                                        </form>
                                        <p id="c2"><?php echo "".$result['SUM(quantity)'].""?></p>
                                        <form action="change.php" method="post" id="c3">
                                        <input type="hidden" name="flag" value="0" required>
                                        <input type="hidden" name="product" value="<?php echo $result['kit']?>" required>
                                        <button id="minus">-</button>
                                        </form>
                                        </td>
                                      <?php echo" <td>Rs ".$result['SUM(cost)']."</td>
                                    </tr>";
                            }
                            $num = mysqli_num_rows($res);
                if($num==0){
                    echo"<td></td><td>No Item Added</td><td> - </td><td>-</td>";
                }
                    ?>
                </tbody>
            </table>
            <div class="float-right text-right">
                <h4>Subtotal:</h4>
                <h1>Rs 
                <?php
                    include 'partials/_dbconnect.php';
                    $username = $_SESSION['username'];
                    $query="Select SUM(cost) from merch where username='$username' group by username";
                    $res = mysqli_query($conn,$query);
                        while($result=mysqli_fetch_assoc($res)){
                            echo $result['SUM(cost)'];
                        }
                        $num = mysqli_num_rows($res);
                if($num==0){
                    echo"0";
                }
                ?>
                </h1>
            </div>
        </div>
    </div>
    <div class="row mt-4 d-flex align-items-center">
        <div class="col-sm-6 order-md-2 text-right">
            <a href="transaction.php" class="btn btn-primary mb-4 btn-lg pl-5 pr-5">Checkout</a>
        </div>
        <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left">
            <a href="merch.php">
                <i class="fas fa-arrow-left mr-2"></i> Continue Shopping</a>
        </div>
    </div>
</div>
</section>
</body>
</html>