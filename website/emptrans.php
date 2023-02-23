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
    #myChart1,#myChart2,#myChart3{
        margin-left: 150px;
    }
    h1{
        text-align: center;
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
        <?php
                include 'partials/_dbconnect.php';
                $query1="Select sum(cost) from ticorders";
                $query2="Select sum(cost) from orders where status='✅'";

                    $res1 = mysqli_query($conn,$query1);
                    $result1=mysqli_fetch_assoc($res1);
                    $res2 = mysqli_query($conn,$query2);
                    $result2=mysqli_fetch_assoc($res2);
                    echo "<h1>Total Net Worth Rs ";
                    echo $result1['sum(cost)']+$result2['sum(cost)'];
                    echo "</h1>";
        ?>
        <hr>
        <div id="myChart1" style="max-width:1200px; height:500px"></div>
        <div id="myChart2" style="max-width:1200px; height:500px"></div>
        <div id="myChart3" style="width: 1200px; height: 500px;"></div>

        <script>
            google.charts.load('current',{packages:['corechart']});
            google.charts.setOnLoadCallback(drawChart1);
            google.charts.setOnLoadCallback(drawChart2);

            function drawChart1() {
            var data = google.visualization.arrayToDataTable([
                ['Type', 'Total cash flow',{ role: "style" }],
                <?php
                include 'partials/_dbconnect.php';
                $query1="Select sum(cost) from ticorders";
                $query2="Select sum(cost) from orders where status='✅'";
                    $res1 = mysqli_query($conn,$query1);
                    $result1=mysqli_fetch_assoc($res1);
                    $res2 = mysqli_query($conn,$query2);
                    $result2=mysqli_fetch_assoc($res2);
                    ?>
                ['Through Tickets',<?php echo $result1['sum(cost)']?>,"blue"],
                ['Through Merchandise',<?php echo $result2['sum(cost)']?>,"red"]
            ]);

            var options = {
                title: 'Finances via Tickets and Merchandise'
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('myChart1'));
            chart.draw(data, options);
        }

        function drawChart2() {
            var data = google.visualization.arrayToDataTable([
                ['Type', 'Total cash flow'],
                <?php
                include 'partials/_dbconnect.php';
                $query1="Select sum(cost) from ticorders";
                    $query2="Select sum(cost) from orders where status='✅'";
                    $res1 = mysqli_query($conn,$query1);
                    $result1=mysqli_fetch_assoc($res1);
                    $res2 = mysqli_query($conn,$query2);
                    $result2=mysqli_fetch_assoc($res2);
                    ?>
                ['Through Tickets',<?php echo $result1['sum(cost)']?>],
                ['Through Merchandise',<?php echo $result2['sum(cost)']?>]
            ]);

            var options = {
                title: 'Finances via Tickets and Merchandise'
            };

            var chart = new google.visualization.PieChart(document.getElementById('myChart2'));
            chart.draw(data, options);
        }

        
        </script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Mon', 20, 28, 38, 45],
      ['Tue', 31, 38, 55, 66],
      ['Wed', 50, 55, 77, 80],
      ['Thu', 77, 77, 66, 50],
      ['Fri', 68, 66, 22, 15]
      // Treat first row as data as well.
    ], true);

    var options = {
      legend:'none'
    };

    var chart = new google.visualization.CandlestickChart(document.getElementById('myChart3c'));

    chart.draw(data, options);
  }
    </script>
</body>
</html>