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
        background: rgb(200, 200, 207);
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
    #id01 input{
        border-radius: 5px;
        text-align: center;
        margin-left: 20px;
        margin-top: 40px;
    }
    #apply{
        margin-left: 400px;
        margin-top: 100px;
        border-radius: 20px;
        background-color: yellowgreen;
        color: white;
    }
    #ins{
        margin-left: 450px;
        margin-top: 10px;
        border-radius: 20px;
        background-color: yellowgreen;
        color: white;
        padding: 10px;
    }
    #insert{
        background: black;
        border-radius: 15px;
        padding: 15px;
        margin-bottom: 10px;
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
<?php
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                include 'partials/_dbconnect.php';
                if($_POST['flag']=='1'){
                    $srn=$_POST['srn'];
                    $img1=$_POST['img1'];
                    $img2=$_POST['img2'];
                    $team1=$_POST['team1'];
                    $team2=$_POST['team2'];
                    $location=$_POST['location'];
                    $cost=$_POST['cost'];
                    $stadium=$_POST['stadium'];
                    $status=$_POST['status'];
                    $time=$_POST['time'];
                    $date=$_POST['date'];
                    $query="update `ticket` set img1 = '$img1' ,img2='$img2',team1 = '$team1' ,team2='$team2' ,location='$location', cost='$cost', stadium='$stadium', status='$status', time='$time',date='$date' where srn='$srn'";
                    $res = mysqli_query($conn,$query);
                    echo "
                    <div id='suc1' style='position: fixed;top: 0;left: 0;width: 1000px;height: 60px;margin: auto;background:yellowgreen;border-radius: 15px;z-index:2;margin-top:110px;margin-left:250px;text-align:center;font-size:x-large;'>
ALERT : UPDATED SUCCESSFULLY!!
</div><script>
    setTimeout(closeshow,4000);
function closeshow(){
    document.getElementById('suc1').style.display='none';
}
</script>
                    ";
                    
                }
                if($_POST['flag']=='2'){
                    $img1=$_POST['img1'];
                    $img2=$_POST['img2'];
                    $location=$_POST['location'];
                    $cost=$_POST['cost'];
                    $stadium=$_POST['stadium'];
                    $status=$_POST['status'];
                    $time=$_POST['time'];
                    $date=$_POST['date'];
                    $query="Delete from `ticket` where srn = (select min(srn) from `ticket` where img1 = '$img1' and img2='$img2' and location='$location' and cost='$cost' and stadium='$stadium' and status='$status' and time='$time' and date='$date')";
                    $res = mysqli_query($conn,$query);
                    echo "
                    <div id='suc2' style='position: fixed;top: 0;left: 0;width: 1000px;height: 60px;margin: auto;background:yellowgreen;border-radius: 15px;z-index:2;margin-top:110px;margin-left:250px;text-align:center;font-size:x-large;'>
ALERT : DELETED SUCCESSFULLY!!
</div><script>
setTimeout(closeshow,4000);
function closeshow(){
    document.getElementById('suc2').style.display='none';
}
</script>
                    ";
                }

                if($_POST['flag']=='3'){
                    $img1=$_POST['img1'];
                    $img2=$_POST['img2'];
                    $team1=$_POST['team1'];
                    $team2=$_POST['team2'];
                    $location=$_POST['location'];
                    $cost=$_POST['cost'];
                    $stadium=$_POST['stadium'];
                    $status=$_POST['status'];
                    $time=$_POST['time'];
                    $date=$_POST['date'];
                    $query="Insert into `ticket` (`img1`,`img2`, `team1`,`team2`, `cost`,`location`,`stadium`, `status`,`time`, `date`) VALUES ('$img1','$img2','$team1','$team2','$cost','$location','$stadium','$status','$time','$date')";
                    $res = mysqli_query($conn,$query);
                    echo "
                    <div id='suc3' style='position: fixed;top: 0;left: 0;width: 1000px;height: 60px;margin: auto;background:yellowgreen;border-radius: 15px;z-index:2;margin-top:110px;margin-left:250px;text-align:center;font-size:x-large;'>
ALERT : INSERTED SUCCESSFULLY!!
</div><script>
setTimeout(closeshow,4000);
function closeshow(){
    document.getElementById('suc3').style.display='none';
}
</script>
                    ";
                }
            }
    ?>
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
                    <br>
                    <br>
                    <br>
                    <h6 class="mb-0" style="font-size: x-large; text-align:center;"><b>TICKETS DATA</h6>
                    <hr>
                    <div id="insert">
            <form method="post" action="emptic.php">
                <input type="hidden" name="flag" value="3">
                <input type="text" name="img1" placeholder="Image 1 src" required>
                <input type="text" name="img2" placeholder="Image 2 src" required>
                <input type="text" name="team1" placeholder="Team 1" required>
                <input type="text" name="team2" placeholder="Team 2" required>
                <input type="text" name="location" placeholder="Location" required>
                <input type="text" name="cost" placeholder="Cost in RS" required>
                <input type="text" name="stadium" placeholder="Stadium" required>
                <input type="text" name="status" placeholder="Status" required>
                <input type="text" name="time" placeholder="Time" required>
                <input type="text" name="date" placeholder="Date" required>
                <button  type="submit" id="ins">INSERT</button>
            </form>
        </div>
                </div>
                <table class="table">
                <thead class="thead-dark">
                <tr>
                <th scope="col">Team</th>
                <th scope="col">Team</th>
                <th scope="col">Location</th>
                <th scope="col">Cost</th>
                <th scope="col">Stadium</th>
                <th scope="col">Status</th>
                <th scope="col">Time</th>
                <th scope="col">Date</th>
                <th></th>
                <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                    include 'partials/_dbconnect.php';
                    $query="Select * from ticket";
                    $res = mysqli_query($conn,$query);
                        while($result=mysqli_fetch_assoc($res)){
                            echo"<tr>
                                    <td>".$result['team1']."</td>
                                    <td>".$result['team2']."</td>
                                    <td>".$result['location']."</td>
                                    <td>Rs ".$result['cost']."</td>
                                    <td>".$result['stadium']."</td>
                                    <td>".$result['status']."</td>
                                    <td>".$result['time']."</td>
                                    <td>".$result['date']."</td>";?>
                                    <td>
                                        <form method="post" action="emptic.php">
                                            <input type="hidden" name="flag" value="0">
                                            <input type="hidden" name="srn" value="<?php echo $result['srn']?>">
                                            <input type="hidden" name="img1" value="<?php echo $result['img1']?>">
                                            <input type="hidden" name="img2" value="<?php echo $result['img2']?>">
                                            <input type="hidden" name="t1" value="<?php echo $result['team1']?>">
                                            <input type="hidden" name="t2" value="<?php echo $result['team2']?>">
                                            <input type="hidden" name="location" value="<?php echo $result['location']?>">
                                            <input type="hidden" name="cost" value="<?php echo $result['cost']?>">
                                            <input type="hidden" name="stadium" value="<?php echo $result['stadium']?>">
                                            <input type="hidden" name="status" value="<?php echo $result['status']?>">
                                            <input type="hidden" name="time" value="<?php echo $result['time']?>">
                                            <input type="hidden" name="date" value="<?php echo $result['date']?>">
                                        <button type="submit"  style="color: white;background:blue;border-radius:15px;padding:10px;">UPDATE</button>
                                        </form>
                                    </td>
                                    <td>
                                            <form method="post" action="emptic.php">
                                            <input type="hidden" name="flag" value="2">
                                            <input type="hidden" name="img1" value="<?php echo $result['img1']?>">
                                            <input type="hidden" name="img2" value="<?php echo $result['img2']?>">
                                            <input type="hidden" name="t1" value="<?php echo $result['team1']?>">
                                            <input type="hidden" name="t2" value="<?php echo $result['team2']?>">
                                            <input type="hidden" name="location" value="<?php echo $result['location']?>">
                                            <input type="hidden" name="cost" value="<?php echo $result['cost']?>">
                                            <input type="hidden" name="stadium" value="<?php echo $result['stadium']?>">
                                            <input type="hidden" name="status" value="<?php echo $result['status']?>">
                                            <input type="hidden" name="time" value="<?php echo $result['time']?>">
                                            <input type="hidden" name="date" value="<?php echo $result['date']?>">
                                        <button  style="color: white;background:red;border-radius:15px;padding:10px;">DELETE</button>
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

    <div id="id01" class="w3-modal">
        <div class="w3-modal-content" style="position: fixed;top: 0;bottom: 0;left: 0;right: 0;width: 900px;height: 500px;margin: auto;backdrop-filter: blur(10px);background-color: rgba(0, 0, 0, 0.485);border-radius: 15px;">
                <header style="color: white; background:blue; border-radius:15px;">
                    <span onclick="mod()">&times;</span>
                    <h2 style="text-align: center;">UPDATE</h2>
                </header>
            <div>
            <form method="post" action="emptic.php">
                <?php
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                include 'partials/_dbconnect.php';
                if($_POST['flag']=='0'){
      ?>
                <input type="hidden" name="flag" value="1">
                <input type="hidden" name="srn" value="<?php echo $_POST['srn'] ?>">
                <input type="text" name="img1" placeholder="<?php echo $_POST['img1'] ?>" value="<?php echo $_POST['img1'] ?>">
                <input type="text" name="img2" placeholder="<?php echo $_POST['img2']  ?>" value="<?php echo $_POST['img2']  ?>">
                <input type="text" name="team1" placeholder="<?php echo $_POST['t1'] ?>" value="<?php echo$_POST['t1'] ?>">
                <input type="text" name="team2" placeholder="<?php echo $_POST['t2']  ?>" value="<?php echo $_POST['t2']  ?>">
                <input type="text" name="cost" placeholder="<?php echo $_POST['cost']  ?>" value="<?php echo $_POST['cost']  ?>">
                <input type="text" name="location" placeholder="<?php echo $_POST['location']  ?>" value="<?php echo $_POST['location']  ?>">
                <input type="text" name="stadium" placeholder="<?php echo $_POST['stadium']  ?>" value="<?php echo $_POST['stadium']  ?>">
                <input type="text" name="status" placeholder="<?php echo $_POST['status']  ?>" value="<?php echo $_POST['status']  ?>">
                <input type="text" name="time" placeholder="<?php echo $_POST['time']  ?>" value="<?php echo $_POST['time']  ?>">
                <input type="text" name="date" placeholder="<?php echo $_POST['date']  ?>" value="<?php echo $_POST['date']  ?>">
                <?php
            }
        }
        ?>
        </div>

        <button id="apply" type="submit">APPLY</button>
            </form>
    </div>
</div>

<script>
mod();
<?php 
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'partials/_dbconnect.php';
    if($_POST['flag']=='0'){
        ?>
        document.getElementById('id01').style.display='block';
        console.log("hi");
        <?php
    }
}
?>
    function mod(){
        document.getElementById('id01').style.display='none';
    }
</script>
</body>
</html>