<?php 
session_start(); 
$conn=mysqli_connect("localhost","root","","shoestore");
if(!isset($_SESSION['Name'])){
header("location: http://localhost/ecommerce website/HTML/index.html");
}
?>