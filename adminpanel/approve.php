<?php 
$conn = mysqli_connect('localhost', 'root', '', 'shoestore') or die("Connection failed: " . mysqli_connect_error());
include 'rolecheck.php';
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$inv=$_GET['inv'];
$cid=$_GET['cid'];
$sql="update orders set payment='completed' where invoice_no='$inv' and customer_id='$cid'";
if(mysqli_query($conn,$sql)){
header("location: http://localhost/ecommerce website/adminpanel/allorder.php");
}

 ?>