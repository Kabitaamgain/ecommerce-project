<?php
session_start();
include '../userpanel/include/nav.php';
// Check if the user is logged in
if (!isset($_SESSION['Email'])) {
  $_SESSION['Notlogin'] = "<script>alert('Please Login First')</script>";
  header("Location: http://localhost/ecommerce%20website/home/index.php");
  exit();
}

// Ensure the 'Id' (user_id) is set in the session
if (!isset($_SESSION['Id'])) {
  $_SESSION['Notlogin'] = "<script>alert('Please Login First')</script>";
  header("Location: http://localhost/ecommerce%20website/home/index.php");
  exit();
}

// Retrieve the user_id from the session
$user_id = $_SESSION['Id'];

// Establish the database connection
$conn = mysqli_connect('localhost', 'root', '', 'shoestore') or die("Connection error");


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>
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
        golden:"#efc66b",
        dimlight:"rgb(0, 0, 0, 0.3)",
        btncolor:"#DFC98A"
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
      @apply text-xl font-semibold text-center mb-2;
     }
div.discription{
        @apply text-center mt-3
}       

h2{
  @apply text-3xl font-semibold text-secondary m-2 text-center
}
input.box, textarea.box{
    @apply p-1 border-2 border-black rounded-lg text-center m-2
}
input.btn{ 
  @apply  border-2 my-3 mx-8 p-2 text-xl bg-btncolor rounded-lg
}
form{
 @apply grid justify-center
}
    </style>

</head>
<body>

<div class="heading">
   <h2>contact us</h2>
</div>

<section class="contact">

   <form action="" method="post" onsubmit="return formvalidation()">
      <h3>say something!</h3>
      <input type="text"  id="uname" name="name" required placeholder="enter your name" class="box">
      <input type="email"  id="eml" name="email" required placeholder="enter your email" class="box">
      <input type="number"  id="phn" name="number" required placeholder="enter your number" class="box">
      <textarea name="message" class="box" placeholder="enter your message" id="" cols="20" rows="3"></textarea>
      <input type="submit" value="send message" name="send" class="btn">
   </form>

</section>
<?php
if(isset($_POST['send'])){

$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$number = $_POST['number'];
$msg = mysqli_real_escape_string($conn, $_POST['message']);

$select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

if(mysqli_num_rows($select_message) > 0){
   echo'<p class="text-tertiory text-center">message sent already! </p>';
 
}else{
   mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
   echo '<p class="text-green-400 text-center">Message sent successfully!</p>';
   
}

}
?>
<?php
include '../userpanel/include/footer.php';
?>
<!-- custom js file link  -->
<script src="../js/script.js"></script>

</body>
</html>