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
    <script
src="https://www.gstatic.com/charts/loader.js">
</script>
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

        <?php
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                include 'partials/_dbconnect.php';
                $username=$_POST['username'];
                $query="Delete from `users` where username ='$username'";
                $res = mysqli_query($conn,$query);
                header("location: empuser.php");
            }
        ?>
        <div class="cart">
        <div class="row no-gutters">
            <div class="col-md-8" style="margin-left: 250px;">
                <div class="product-details mr-2">
                    <h6 class="mb-0" style="font-size: x-large; text-align:center;"><b>User Info</h6>
                    <hr>
                </div>
                <table class="table">
                <thead class="thead-dark">
                <tr>
                <th scope="col">User</th>
                <th scope="col">Password</th>
                <th scope="col">Date of Joining</th>
                <th scope="col">Spent on Tickets</th>
                <th scope="col">Spent on Merchandise</th>
                <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                    include 'partials/_dbconnect.php';
                    $query="Select * from users";
                    $res = mysqli_query($conn,$query);
                        while($result=mysqli_fetch_assoc($res)){
                            echo"<tr>
                                    <td>".$result['username']."</td>
                                    <td>*******</td>
                                    <td>".$result['dt']."</td>
                                    ";
                                    $usr = $result['username'];
                                    $query1="Select sum(cost) from orders where status='✅' and username ='$usr'";
                                    $res1 = mysqli_query($conn,$query1);
                                    $result1=mysqli_fetch_assoc($res1);

                                    $query2="Select sum(cost) from ticorders where user ='$usr'";
                                    $res2 = mysqli_query($conn,$query2);
                                    $result2=mysqli_fetch_assoc($res2);
                                    if($result2['sum(cost)']!=null){
                                    echo" <td>Rs ".$result2['sum(cost)']."</td>";
                                    }
                                    else{
                                        echo" <td>Rs 0</td>";
                                    }
                                    if($result1['sum(cost)']!=null){
                                    echo "<td>Rs ".$result1['sum(cost)']."</td>";
                                    }
                                    else{
                                        echo" <td>Rs 0</td>";
                                    }
                                    ?>
                                    <td>
                                        <form method="post" action="empuser.php">
                                        <input type="hidden" name="username" value="<?php echo $result['username']?>">
                                            <button style="color: white;border-radius:12px;background:red;padding:5px;">DELETE</button>
                                        </form>
                                    </td>
                                    <?php echo "</tr>";
                        }
                ?>
            </tbody>
                </table>
            </div>
            </div>
            </div>
</body>
</html>