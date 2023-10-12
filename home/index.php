<?php 
session_start();
if(isset($_SESSION['Notlogin'])){
	echo $_SESSION['Notlogin'];
	unset($_SESSION['Notlogin']);
}else{
	echo "";
}
$conn = mysqli_connect('localhost', 'root', '', 'shoestore') or die("connection failed: " . mysqli_connect_error());
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);
$sql1="select * from cart";
$result1=mysqli_query($conn, $sql1);
$quantity=mysqli_num_rows($result1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ecommerce website</title>
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
  <nav class="flex justify-between shadow-md  text-[17px]">
    <ul class="flex gap-16 py-5 font-semibold container">
      <li class="hover:text-secondary"><a href="#">Home</a></li>
      <li class="hover:text-secondary"><a href="aboutus.php">About</a></li>
      <li class="hover:text-secondary"><a href="../userpanel/contact.php">Contact</a></li>
      <form action="../userpanel/categories.php" method="POST">
        <?php $sql="select * from categories" ;
        $result2=mysqli_query($conn, $sql);
        if(mysqli_num_rows($result2)>0){
        ?>
        <select name="category" id="1" class="bg-primary" onchange="this.form.submit();">
          <option value="" class="bg-primary" disabled selected>Categories</option>
          <?php 
          while($rows=mysqli_fetch_assoc($result2)){

          ?>
          <option value="<?php echo $rows['category_id'] ;?>" ><?php echo $rows['category'];?></option>
       <?php } ?>
       <!-- <input type="submit" name="submit_category" value="Show"> -->
        </select>
       <?php } ?>
      <!-- <li class="">Categories<i class="fas fa-caret-down mx-1" onclick="dropdown()"ondblclick="drphide()"></i></a>
        <ul class="dropdown absolute block bg-light p-5 hidden" id="drp">
        <li class="hover:bg-secondary my-3 border px-2" ><button name="men">Men Shoes</button></li>
        <li class="hover:bg-secondary my-3 border px-2 " ><button name="women">women</button></li>
        <li class="hover:bg-secondary my-3  border px-2" ><button name="kids">kids</button></li>
        </ul>
      </li> -->
      </form>

      <li class="hover:text-secondary" onclick="display()"><a href="#">Account</a></li>
      <li class="flex">
        <a href="../userpanel/cart.php">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
</svg>
</a>

  </li>

    </ul>

   
    <form action="../userpanel/search.php" method="GET" class="flex my-5 mr-4 py-1 px-3 rounded-2xl border border-black bg-white">
  <input type="search" placeholder="Search" name="search" class="focus:outline-none" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"> 
  <button type="submit"><i class="fa-solid fa-magnifying-glass py-1"></i></button>
</form>

  </nav>
</div>

<!-- sign up form -->
<div class="form-box mt-5 w-88 mx-96 hidden absolute" id="frm">
  <div class="form bg-dimlight p-10 text-center absolute ">
    <h2 class="absolute top-0 right-0 mt-3 mr-5 text-white" id="icn" onclick="hide()"><i class="fa-solid fa-xmark"></i></h2>
    <form action="../userpanel/login.php" method="post" id="lgn" class="login-form">
      <h2>Login</h2>
      <label class="form-label"></label>
      <input type="email" class=" inputitem" placeholder="Email" name="lemail" required>
      <label class="form-label"></label>
      <input type="password" class=" inputitem" placeholder="Password" name="lpassword" required><br>
      <button class="bg-secondary px-4 py-2 rounded-lg m-2" name="submit">LOGIN</button>
      <p class="text-white text-xl">Not register?<a href="#" onclick="register()"class="text-secondary">Register</a></p>
    </form>

    <form action="../userpanel/register.php" method="post" class="hidden" id="rgst">
      <h2>Register</h2>
      <label class="form-label"></label>
      <input type="text" class="inputitem" placeholder="Username"name="username" id="uname" >
      <span style="color:red;" id="username"></span>
      <label class="form-label"></label>
      <input type="email" class="inputitem" placeholder="Email" name="email" id="eml" >
      <span style="color:red;" id="email"></span>
      <label class="form-label"></label>
      <input type="phone" class="inputitem" placeholder="Phone" name="phone" id="phn" >
      <span style="color:red;" id="phone"></span>
      <label class="form-label"></label>
      <input type="password" class="inputitem" placeholder="Password" name="password" id="pass" >
      <span style="color:red;" id="password"></span>
      <label class="form-label"></label>
      <input type="password" class="inputitem" placeholder="Confrim Password" name="cpassword" id="cpass">
      <span style="color:red;" id="cpassword"></span>
      <button  class="bg-secondary px-4 py-2 rounded-lg m-2" name="submit">REGISTER</button>
      <p class="text-white text-xl ">Already register?<a href="#" onclick="login()" class="text-secondary">Login</a></p>
    </form>
  </div>
</div>
<script type="text/javascript" src="../js/script.js"></script>

  <!-- main section -->
  <div class="container flex gap-10 mt-12">
    <div class="mt-24 w-8/12">
      <h1>SHOES <br> COLLECTION</h1>
      <h2 class="text-2xl text-secondary italic mt-5">Latest & Stylish Shoes for Men & Women in Fashion</h2>
      <button class="bg-tertiory p-2 my-2 mx-10 rounded-2xl text-white font-semibold hover:bg-secondary">EXPLORE <i
          class="fa fa-arrow-right"></i></button>
    </div>
    <div class="w-10/12">
      <img src="../image/shose.jpg">
    </div>
  </div>

  <!-- featured section -->
  <div>
  <h1 class=" text-center mt-16 mb-10">Featured Product</h1>
  <div class="container grid grid-cols-3 gap-10">
<?php 
$count=0;
if (mysqli_num_rows($result) > 0) {
  while ($rows = mysqli_fetch_assoc($result)) {
    $count++;
    $image = $rows['image'];
    $price = $rows['price'];
    $description = $rows['description'];
    $product_name=$rows['product_name'];
    $id=$rows['product_id'];
   ?>
     <form action="add_to_cart.php" method="get">
   <div class="w-[300px] mt-4">
    <img src="../image/<?php echo $image ;?>" class="w-full h-80 object-cover">
    <div class="discription">
      <h4><?php echo $product_name;?></h4>
      <i class="fa fa-star text-light hover:text-golden"></i>
      <i class="fa fa-star text-light hover:text-golden"></i>
      <i class="fa fa-star text-light hover:text-golden"></i>
      <i class="fa fa-star text-light hover:text-golden"></i>
      <i class="fa fa-star text-light hover:text-golden"></i>
      <p>price: Rs.<?php echo $price; ?></p>
      <p class="mb-5"><?php echo $description; ?></p>
      <input type="hidden" name="product_id" value="<?php echo $id; ?>">
      <a  name="cart" class="border bg-btncolor p-3 rounded-lg text-white text-xl mt-10" href="../userpanel/detail.php?id=<?php echo $id;?>">View More</a>
    </div>
  </div>
  </form>
  <?php
    if ($count == 3) {
      break;
    }
  }
}
else {
  echo 'No products found.';
}
?>
</div>
</div>

<!-- All product -->
<div>
  <h1 class=" text-center mt-16 mb-10">ALL Product</h1>
  <div class="container grid grid-cols-3 gap-10">
<?php 
$count=0;
if (mysqli_num_rows($result) > 0) {
  while ($rows = mysqli_fetch_assoc($result)) {
    $count++;
    $image = $rows['image'];
    $price = $rows['price'];
    $description = $rows['description'];
    $product_name=$rows['product_name'];
    $id=$rows['product_id'];
   ?>
     <form action="add_to_cart.php" method="get">
   <div class="w-[300px] mt-4">
    <img src="../image/<?php echo $image ;?>" class="w-full h-80 object-cover">
    <div class="discription">
      <h4><?php echo $product_name;?></h4>
      <i class="fa fa-star text-light hover:text-golden"></i>
      <i class="fa fa-star text-light hover:text-golden"></i>
      <i class="fa fa-star text-light hover:text-golden"></i>
      <i class="fa fa-star text-light hover:text-golden"></i>
      <i class="fa fa-star text-light hover:text-golden"></i>
      <p>price: Rs.<?php echo $price; ?></p>
      <p class="mb-5"><?php echo $description; ?></p>
      <input type="hidden" name="product_id" value="<?php echo $id; ?>">
      <a  name="cart" class="border bg-btncolor p-3 rounded-lg text-white text-xl mt-10" href="../userpanel/detail.php?id=<?php echo $id;?>">View More</a>
    </div>
  </div>
  </form>
  <?php
    if ($count == 6) {
      break;
    }
  }
}
else {
  echo 'No products found.';
}
?>
</div>
</div>

<div class="text-center mt-16">
<a  name="cart" class="border bg-tertiory p-3 rounded-lg text-white font-semibold text-xl mt-10 px-20" href="../userpanel/viewall.php?id=<?php echo $id;?>">View All Products</a>
</div>
  
<!-- footer section -->
<footer class="bg-light text-center p-5 mt-10">
  <i class="fa-brands fa-facebook p-4"></i>
	<i class="fa-brands fa-instagram p-4"></i>
	<i class="fa-brands fa-twitter p-4"></i>
	<p class="text-white text-xl">copyright &copy2023 Kabita Amgain</p>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", function() {

      var form = document.getElementById("rgst");

      // Validate email
      var emailInput = document.querySelector("input[name='email']");
      emailInput.addEventListener("input", function() {
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$/;
        if (emailRegex.test(emailInput.value)) {
          emailInput.style.borderColor = "green";
          document.getElementById('email').innerHTML="";
        } else {
          emailInput.style.borderColor = "red";
          document.getElementById('email').innerHTML="Email is not valid";
        }
      });

      // Validate phone number
      var phoneInput = document.querySelector("input[name='phone']");
      phoneInput.addEventListener("input", function() {
        var phoneRegex = /^\d{10}$/;
        if (phoneRegex.test(phoneInput.value)) {
          phoneInput.style.borderColor = "green";
          document.getElementById('phone').innerHTML="";
        } else {
          phoneInput.style.borderColor = "red";
          document.getElementById('phone').innerHTML="Phone number is at least 6 characters";
        }
      });


      // Validate password and confirm password
var newPasswordInput = document.querySelector("input[name='password']");
var newconPasswordInput = document.querySelector("input[name='cpassword']");
newPasswordInput.addEventListener("input", function() {
  if (newPasswordInput.value.length >= 6) {
    newPasswordInput.style.borderColor = "green";
    document.getElementById('password').innerHTML = "";
  } else {
    newPasswordInput.style.borderColor = "red";
    document.getElementById('password').innerHTML = "Password should be at least 6 characters long";
  }
  // Check if passwords match
  if (newPasswordInput.value === newconPasswordInput.value) {
    newconPasswordInput.style.borderColor = "green";
    document.getElementById('cpassword').innerHTML = "";
  } else {
    newconPasswordInput.style.borderColor = "red";
    document.getElementById('cpassword').innerHTML = "Passwords do not match";
  }
});

newconPasswordInput.addEventListener("input", function() {
  if (newconPasswordInput.value.length >= 6) {
    newconPasswordInput.style.borderColor = "green";
    document.getElementById('cpassword').innerHTML = "";
  } else {
    newconPasswordInput.style.borderColor = "red";
    document.getElementById('cpassword').innerHTML = "Password should be at least 6 characters long";
  }
  // Check if passwords match
  if (newPasswordInput.value === newconPasswordInput.value) {
    newPasswordInput.style.borderColor = "green";
    document.getElementById('password').innerHTML = "";
  } else {
    newPasswordInput.style.borderColor = "red";
    document.getElementById('password').innerHTML = "Passwords do not match";
  }
});

      // Validate name
      var nameInput = document.querySelector("input[name='username']");
      nameInput.addEventListener("input", function() {
        if (nameInput.value.trim() !== "" && nameInput.value.match(/[a-zA-Z]/) && nameInput.value.trim().length >= 3) {
          nameInput.style.borderColor = "green";
          document.getElementById('username').innerHTML="";
        } else {
          nameInput.style.borderColor = "red";
          document.getElementById('username').innerHTML="Name should not be empty and Number only";
        }
      });

       

  
      // Form submission event
      form.addEventListener("submit", function(e) {
        if (
          emailInput.style.borderColor === "red" ||
          phoneInput.style.borderColor === "red" ||
          nameInput.style.borderColor === "red" 
        ) {
          e.preventDefault();  // Stop the form from submitting
          alert("Please correct the highlighted fields before submitting.");
        }
      });

    });
</script>


</body>
</html>















<!-- <script>
document.addEventListener("DOMContentLoaded", function() {
var form = document.getElementById("myForm");
// Validate email
var emailInput = document.querySelector("input[name='email']");
emailInput.addEventListener("input", function() {
var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$/;
if (emailRegex.test(emailInput.value)) {
emailInput.style.borderColor = "green";
document.getElementById('email').innerHTML="";
} else {
emailInput.style.borderColor = "red";
document.getElementById('email').innerHTML="Email is not valid";
}
});
// Validate phone number
var phoneInput = document.querySelector("input[name='phone']");
phoneInput.addEventListener("input", function() {
var phoneRegex = /^\d{10}$/;
if (phoneRegex.test(phoneInput.value)) {
phoneInput.style.borderColor = "green";
document.getElementById('number').innerHTML="";
} else {
phoneInput.style.borderColor = "red";
document.getElementById('number').innerHTML="Phone number is at least 10 characters";
}
});
// Validate password
var newPasswordInput = document.querySelector("input[name='newpassword']");
newPasswordInput.addEventListener("input", function() {
if (newPasswordInput.value.length >= 8) {
newPasswordInput.style.borderColor = "green";
document.getElementById('newpassword').innerHTML="";
} else {
newPasswordInput.style.borderColor = "red";
document.getElementById('newpassword').innerHTML="Password should be at least 8 characters long";
}
});
// Validate OTP
var otpInput = document.querySelector("input[name='password']");
otpInput.addEventListener("input", function() {
var otpRegex = /^\d{6}$/;
if (otpRegex.test(otpInput.value)) {
otpInput.style.borderColor = "green";
document.getElementById('password').innerHTML="";
} else {
otpInput.style.borderColor = "red";
document.getElementById('password').innerHTML="OTP should be a 6-digit number";
}
});
// Validate image format
var imageInput = document.querySelector("input[name='image']");
imageInput.addEventListener("change", function() {
var validExtensions = /(\.jpg|\.jpeg|\.png)$/i;
if (validExtensions.test(imageInput.value)) {
imageInput.style.borderColor = "green";
document.getElementById('image').innerHTML="";
} else {
imageInput.style.borderColor = "red";
document.getElementById('image').innerHTML="Only .jpg, .jpeg, and .png formats are allowed";
}
});
// Form submission event
form.addEventListener("submit", function(e) {
if (
emailInput.style.borderColor === "red" ||
phoneInput.style.borderColor === "red" ||
newPasswordInput.style.borderColor === "red" ||
otpInput.style.borderColor === "red" ||
imageInput.style.borderColor === "red"
) {
e.preventDefault();  // Stop the form from submitting
alert("Please correct the highlighted fields before submitting.");
}
});
});
</script> -->