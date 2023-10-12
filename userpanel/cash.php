
<?php 
$conn=mysqli_connect('localhost','root','','shoestore') or die("Connection error");
session_start();
echo $user_id=$_SESSION['Id'];
  $name=$_POST['name'];
 echo $pid=$_POST['pid'];
  $inv=$_POST['inv'];
  $price=$_POST['prc'];
  $phone=$_POST['phone'];
  $email=$_POST['email'];
  $address=$_POST['address'];
  $method=$_POST['method'];
         

    $sql1= "update orders set cname='$name',cphone='$phone',caddress='$address', email='$email', method='cash',payment='pending' where invoice_no='$inv'";
   if(mysqli_query($conn,$sql1)){
      $deleteQuery = "DELETE FROM cart WHERE user_id='$user_id' AND product_id='$pid'";
      if(mysqli_query($conn, $deleteQuery)){
         $_SESSION['suscadd']="<script>alert('Your Order has been successfully added!')</script>";
         header("Location: http://localhost/ecommerce%20website/userpanel/home.php");
      }
      
   }

?>