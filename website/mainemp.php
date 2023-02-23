<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: emp.php");
    exit;
}
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
    #myChart1,#myChart2,#myChart3{
        margin-left: 300px;
        border-radius: 20px;
        margin-top: 30px;
        padding: 20px;
        box-shadow: 5px 5px 10px black;
        transition-timing-function: ease-in-out;
        transition-duration: 0.25s;
    }
    #myChart1:hover,#myChart2:hover,#myChart3:hover{
        box-shadow: 5px 5px 40px black;
        transform: scale(1.04);
        transition-duration: 0.25s;
    }
    p{
        font-family: 'Times New Roman', Times, serif;
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
        <p style="font-size: xx-large; margin-top:40px; text-align:center;">
        Welcome 
        <?php 
        include 'partials/_dbconnect.php';
        $emd = $_SESSION['empid'];
        $sql="Select name from emp where empid='$emd'";
        $res = mysqli_query($conn,$sql);
        $result=mysqli_fetch_assoc($res);
        echo $result['name'];
        ?>
        !!
        </p>
        <HR>

        <div id="myChart1" style="max-width:950px; height:450px"></div>
        <div id="myChart2" style="max-width:950px; height:450px"></div>
        <div id="myChart3" style="max-width:950px; height:450px"></div>


        <script>
            google.charts.load('current',{packages:['corechart']});
            google.charts.setOnLoadCallback(drawChart1);
            google.charts.setOnLoadCallback(drawChart2);
            google.charts.setOnLoadCallback(drawChart3);

            function drawChart1() {
            var data = google.visualization.arrayToDataTable([
                ['Merchandise', 'Customers'],
                <?php
                include 'partials/_dbconnect.php';
                $sql="Select kit,count(kit) from orders where status='✅' group by kit ";
                $res = mysqli_query($conn,$sql);
                while($result=mysqli_fetch_assoc($res)){
                    ?>
                ['<?php echo $result['kit']?>',<?php echo $result['count(kit)']?>],
                <?php
                }
                ?>
            ]);

            var options = {
                title: 'Merch Vs Customer'
            };

            var chart = new google.visualization.BarChart(document.getElementById('myChart1'));
            chart.draw(data, options);
        }

        function drawChart2() {
            var data = google.visualization.arrayToDataTable([
                ['Stadium', 'Attendence'],
                <?php
                include 'partials/_dbconnect.php';
                $sql="Select stadium,count(stadium) from ticket group by stadium";
                $res = mysqli_query($conn,$sql);
                while($result=mysqli_fetch_assoc($res)){
                    ?>
                ['<?php echo $result['stadium']?>',<?php echo $result['count(stadium)']?>],
                <?php
                }
                ?>
            ]);

            var options = {
                title: 'Stadium Vs Attendence'
            };

            var chart = new google.visualization.PieChart(document.getElementById('myChart2'));
            chart.draw(data, options);
        }

        function drawChart3() {
            var data = google.visualization.arrayToDataTable([
                ['Successfull', 'Failed'],
                <?php
                include 'partials/_dbconnect.php';
                $sql="Select count(status) from orders where status='✅'";
                $res = mysqli_query($conn,$sql);
                while($result=mysqli_fetch_assoc($res)){
                    ?>
                ['Successfull',<?php echo $result['count(status)']?>],
                <?php
                }
                $sql2="Select count(status) from orders where status='❌'";
                $res2 = mysqli_query($conn,$sql2);
                while($result2=mysqli_fetch_assoc($res2)){
                    ?>
                ['Failed',<?php echo $result2['count(status)']?>],
                <?php
                }
                ?>
            ]);

            var options = {
                title: 'Transactions'
            };

            var chart = new google.visualization.PieChart(document.getElementById('myChart3'));
            chart.draw(data, options);
        }
        </script>
        
</body></html>