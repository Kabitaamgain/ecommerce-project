<?php 
if(isset($_SESSION['uname'])){
// Get the logged-in user's name
$uname = $_SESSION['uname'];

// Define a message based on the user's name
$message = '';
if ($uname === 'admin') {
    $message = 'Hello, Admin!';
} else {
    $message = 'Hello, ' . $uname . '!';
}
}
else{
  $message='';
}
if(!isset($_SESSION['Email'])){
header("location: http://localhost/ecommerce website/home/index.php");
}
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

<body class="">
  <!-- navbar -->
  <div class="sticky top-0 bg-white">
  <nav class="grid grid-cols gap-5  shadow-md ml-2 text-lg bg-[#131a36] text-white text-center w-[200px] h-[100%]">
    <ul class="grid grid-cols gap-5 py-5 font-semibold ">
    <ul class="flex pl-8">
      <li class="hover:text-secondary flex gap-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mt-1">
  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
</svg>
<?php echo $message; ?></li>
      </ul>
      <li class="hover:text-secondary"><a href="index.php">Dashboard</a></li>
      <li class="hover:text-secondary"><a href="users.php">Users</a></li>
      <li class="hover:text-secondary"><a href="product.php" >Product</a></li>
      <li class="hover:text-secondary"><a href="allorder.php">All orders</a></li>
      <li class=""><a href="categories.php">Categories </a></li>
   <li class="hover:text-secondary"><a href="messages.php">Messages</a></li>
    <ul class=" my-3 font-semibold grid grid-cols ">
      <li class="hover:text-secondary"><a href="../userpanel/logout.php">Logout</a></li>
    </ul>
</nav>
  </div>
</body>
</html>