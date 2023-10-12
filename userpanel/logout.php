<?php 
$conn=mysqli_connect("localhost","root","","shoestore");
session_start();
session_unset();
session_destroy();
header("location: http://localhost/ecommerce website/home/index.php");
 ?>