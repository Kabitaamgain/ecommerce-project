<div class="flex bg-primary gap-10 h-full">
<div>
<?php
session_start();
include 'include/nav.php';
include 'rolecheck.php';
?>
</div>

<div>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
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
      @apply text-2xl font-semibold text-secondary m-2
    }
    input[type="text"],
input[type="Number"],
textarea
{
  @apply px-4 py-2 rounded border-2 border-black w-80 mt-2 block text-xl 
}
input[type="file"]{
  @apply block px-4 py-2 block mt-2 text-xl mx-auto
}
form{
  @apply bg-formcolor w-96 h-[400px] pl-8 py-4 container
}
label{
  @apply text-xl
}

button{ 
  @apply  border-2 my-3 mx-20 p-2 text-xl
}
input[type="text"],
input[type="Number"],
input[type="email"],
input[type="password"]
{
  @apply px-4 py-2 rounded border-2 border-black w-80 mt-0.5 block text-xl
}


        </style>
</head>
<body>
<h3 class="text-xl font-semibold mb-5 text-center">Add New User</h3>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return adduservalidation()">
  <label>Username:</label>
      <input type="text" name="uname" id="uname" required>
      <label>Email:</label>
      <input type="email"  name="email" id="eml" required>
      <label>Phone:</label>
      <input type="Number"  name="phone" id="phn" required>
      <label >Password:</label>
      <input type="password" name="password" id="pass" required>
<button type="submit" name="submit" class="bg-primary">Add User</button>
</form>

<script type="text/javascript" src="../js/script.js"></script>

</body>
</html>
<?php  
if (isset($_POST['submit'])) {
  $name = $_POST['uname'];
  $email=$_POST['email'];
  $password = $_POST['password'];
  $phone = $_POST['phone'];

  $sql="select email from register where email='$email'";
  $result=mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)>0){
    echo '<p className="text-tertiory">Provided Email address is already used..</p>';
  }
else{
  $sql ="INSERT INTO `register`( `userName`, `email`, `password`,`role`, `phone`) VALUES ('$name', '$email', '$password','user','$phone')";
 if(mysqli_query($conn, $sql)) {
    header("location:http://localhost/ecommerce website/adminpanel/users.php");
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}

}
?>
</div>
</div>
