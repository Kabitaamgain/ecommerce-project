<?php
if (isset($_REQUEST['submit'])) {
$conn=mysqli_connect('localhost','root','','shoestore') or die("Connection error");
$email=$_REQUEST['lemail'];
$password=$_REQUEST['lpassword'];
$sql="select id,userName,email,password,role from register where email='$email' and password='$password'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
	while ($rows=mysqli_fetch_assoc($result)) {
		session_start();
		$_SESSION['Email']=$rows['email'];
		$_SESSION['uname']=$rows['userName'];
		$_SESSION['Id']=$rows['id'];
		$_SESSION['Role']=$rows['role'];
		if($_SESSION['Role']=='Admin'){
header("location: http://localhost/ecommerce website/adminpanel/index.php");
}else{
header("location: http://localhost/ecommerce website/userpanel/home.php");
}
	}
}
else{
		echo "Email and password doesn't match";
	}
}
?>