<?php
session_start();

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

// Get the 'id' parameter from the URL
if (!isset($_GET['id'])) {
  // Handle the case when 'id' is not provided in the URL
  // Redirect the user to an error page or take appropriate action
  header("Location: http://localhost/ecommerce%20website/error.php");
  exit();
}
$id = $_GET['id'];
if(isset($_GET['product_quantity'])){
  $quantity=$_GET['product_quantity'];
}else{
  $quantity=1;
}
// Check if the product already exists in the cart for the current user
$sql_check = "SELECT * FROM cart WHERE product_id = '$id' AND user_id = '$user_id'";
$result_check = mysqli_query($conn, $sql_check);

if (mysqli_num_rows($result_check) > 0) {
  // If the product already exists, display an alert and redirect the user back to the home page
  $_SESSION['aadded']= "<script>alert ('Already added!')</script>";
  header("Location: http://localhost/ecommerce%20website/userpanel/home.php");
  exit();
} else {

  // If the product doesn't exist in the cart, insert it
  $sql_insert = "INSERT INTO cart (product_id, quantity, user_id) VALUES ('$id','$quantity', '$user_id')";
  if (mysqli_query($conn, $sql_insert)) {
    header("Location: http://localhost/ecommerce%20website/userpanel/home.php");
    exit();
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}

// Close the database connection
mysqli_close($conn);
?>

 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>website</title>
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
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
    h1{
          @apply text-5xl font-semibold;
         }
    div.discription{
            @apply text-center mt-3
    }       
    input.inputitem{
      @apply m-2 p-3 rounded-lg text-center
    }
    h2{
      @apply text-2xl font-semibold text-secondary m-2
    }
        </style>
</head>

<body class="bg-primary">
  <!-- navbar -->
  <div class="sticky top-0 bg-primary">
  <nav class="flex justify-between shadow-md container text-lg">
    <ul class="flex gap-16 py-5 font-semibold ">
      <li class="hover:text-secondary"><a href="#">Home</a></li>
      <li class="hover:text-secondary"><a href="#">About</a></li>
      <li class="hover:text-secondary"><a href="#">Contact</a></li>
      <!-- <li ><a href="#" class="hover:text-secondary"  >Categories<i class="fas fa-caret-down mx-1" onclick="dropdown()"ondblclick="drphide()"></i></a>
        <ul class="dropdown absolute block bg-light p-5 hidden" id="drp">
        <li class="hover:text-secondary my-3" ><a href="#">Men Shoes</a></li>
        <li class="hover:text-secondary my-3" ><a href="#">Women Shoes</a></li>
        <li class="hover:text-secondary my-3" ><a href="#">Running Shoes</a></li>
        </ul>
      </li> -->
    </ul>

  
<!-- footer section -->
<footer class="bg-light text-center p-5 mt-10">
  <i class="fa-brands fa-facebook p-4"></i>
	<i class="fa-brands fa-instagram p-4"></i>
	<i class="fa-brands fa-twitter p-4"></i>
	<p class="text-white text-xl">copyright &copy2023 Kabita Amgain</p>
</footer>
</body>
</html>