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
    if($_POST["flag"]==1){
        $username = $_SESSION['username'];
        $img = $_POST["img"];
        $kit = $_POST["product"];
        $cost = $_POST["cost"];
        $quantity = $_POST["quantity"];
    $sql="INSERT INTO `merch` (`username`,`img`, `kit`,`quantity`, `cost`) VALUES ('$username','$img','$kit','$quantity','$cost')";
    $result = mysqli_query($conn,$sql);
        header("location: addcart.php");
    }
    if($_POST["flag"]==0){
        $product = $_POST['product'];
        $username = $_SESSION['username'];
        $query="Delete from merch where srn=(Select min(srn) from merch where username='$username' and kit ='$product')";
        $res = mysqli_query($conn,$query);
        header("location: addcart.php");
    }
    if($_POST["flag"]==2){
        $product = $_POST['product'];
        $username = $_SESSION['username'];
        $query="Delete from merch where username='$username' and kit ='$product'";
        $res = mysqli_query($conn,$query);
        header("location: addcart.php");
    }
}
?>