<div class="flex gap-10 bg-primary h-full">
<div>
<?php 
session_start();
include 'include/nav.php';
include 'rolecheck.php';
if(isset($_REQUEST['usubmit'])){
$id=$_REQUEST['uid'];
$name=$_REQUEST['uname'];
$email=$_REQUEST['email'];
$role=$_REQUEST['role'];
$phone=$_REQUEST['phone'];

$sqll="update register set userName='$name',role='$role',phone='$phone' where id='$id'";
if (mysqli_query($conn,$sqll)) {
	header("location: http://localhost/ecommerce%20website/adminpanel/users.php");
	}
else{
echo "Unable to update";

}
}
 ?>
</div>
<div>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<script src="../css/tailwindcss.css"></script>
	<link rel="stylesheet" type="text/css"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<script>
tailwind.config = {
  theme: {
	extend: {
	  colors: {
		primary: "mintcream",
		secondary: "#a34a38",
		tertiory: "orangered",
		light:"#b0ada8",
		formcolor:"#ebe8dd"
	  },
	  container: {
		center: true,
		padding: {
		  DEFAULT: '1rem',
		  sm: '2rem',
		  lg: '4rem',
		  xl: '5rem',
		  '2xl': '6rem',
		},
	  },
	}
  }
}
</script>
	<style type="text/tailwindcss">
    h3{
      @apply text-2xl font-semibold text-secondary m-2 text-center my-5
    }

	form{
  @apply bg-formcolor w-96 h-96 pl-8 py-4 container rounded-lg
}

button{ 
  @apply border-2 my-3 mx-20 w-40 p-2 text-xl rounded-lg
}
input[type="text"],
input[type="Number"],
input[type="email"],
input[type="password"]
{
  @apply px-4 py-2 rounded border-2 border-black w-80 mt-1 block mb-5 text-xl;
}
</style>
 </head>
 <body>
 <?php 
	$id=$_REQUEST['id'];
	$sql="select id,userName,email,role,phone from register where id='$id'";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0){
		while ($rows=mysqli_fetch_assoc($result)) {
	 ?>
	 
	 <h3>Edit User</h3>
	 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return editformValidation()">
      <input type="hidden" name="uid" value="<?php echo $rows['id']; ?>">
      <input type="text" name="uname" id="uname" value="<?php echo $rows['userName']; ?>">
      <input type="text" name="email" value="<?php echo $rows['email']; ?>" readonly>
      <input type="text" name="role" id="role" value="<?php echo $rows['role']; ?>">
      <input type="text" name="phone" id="phone" value="<?php echo $rows['phone']; ?>">
      <button type="submit" name="usubmit" class="bg-primary">Update</button>
    </form>
    <?php 
    }
}
    ?>
  </div>
</div>
<!-- footer section -->
<?php 
include 'include/footer.php';
?>

<script>
  function editformValidation() {
    var username = document.getElementById("uname").value;
    var role = document.getElementById("role").value;
    var phone = document.getElementById("phone").value;

    var nameRegex = /^[A-Za-z]+$/;
    if (!nameRegex.test(username)) {
      alert("Name should only contain letters.");
      return false;
    }
    // Name should contain at least 3 letters
    if (username.length < 3) {
      alert("Name should have at least 3 letters.");
      return false;
    }

    // Validate role (should be "user" or "admin")
    if (role !== "user" && role !== "admin") {
      alert("Role should be either 'user' or 'admin'.");
      return false;
    }

    // Validate phone number (length)
    if (phone.length !== 10) {
      alert("Please enter a valid 10-digit phone number.");
      return false;
    }

    return true; // All validations passed
  }
</script>
 </body>
 </html>