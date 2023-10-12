<?php   
include 'rolecheck.php';
$id=$_REQUEST['id'];
$sql="delete from register where id='$id'";
if (mysqli_query($conn,$sql)) {
	header("location: http://localhost/ecommerce website/adminpanel/users.php");
	}
else{
echo "Unable to update";

}	
?>