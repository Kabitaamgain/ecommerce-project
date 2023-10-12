<?php 
if (isset($_REQUEST['submit'])) {
	$conn=mysqli_connect('localhost','root','','shoestore') or die("Connection error");
 $uname = $_REQUEST['username'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$password = $_REQUEST['password'];
$cpassword = $_REQUEST['cpassword'];

// Check if email already exists
$sql = "SELECT email FROM register WHERE email='$email'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    echo "Email already exists";
} else {
    // Insert new user into database
    $sql = "INSERT INTO register (userName, email, phone, password, role) VALUES ('$uname', '$email', '$phone', '$password', 'user')";
    if (mysqli_query($conn, $sql)) {
		header("location: http://localhost/ecommerce website/home/index.php");
    } else {
        echo "Query Failed";
    }
}
}
else{
    echo "Password is not match";
}
?>
