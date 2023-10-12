<?php 
$conn = mysqli_connect('localhost', 'root', '', 'shoestore') or die("Connection failed: " . mysqli_connect_error());
if(isset($_SESSION['role'])){
if($_SESSION['role']=='user'){ 
 header("location: http://localhost/ecommerce website/userpanel/home.php");
}
}
?>