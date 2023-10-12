<?php
$conn=mysqli_connect('localhost','root','','shoestore') or die("Connection error");
session_start();

if(!isset($_SESSION['Email'])){
  header("location: http://localhost/ecommerce website/home/");
}
// include 'include/nav.php';
$user_id=$_SESSION['Id'];
if(!isset($_SESSION['Email'])){

  $_SESSION['Notlogin']="<script>alert('Please Login First')</script>";

  header("location: http://localhost/ecommerce website/home/index.php");
}
if (isset($_GET['id'])) {
  $pid = $_GET['id'];

  if(isset($_GET['quantity'])){
  $quantity=$_GET['quantity'];
}else{
  $quantity=1;
}
  $user_id=$_SESSION['Id'];


  $sql = "SELECT * FROM product WHERE product_id = $pid";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $productName = $row['product_name'];
    $price = $row['price'];
    $totalprice= $price*$quantity;
    $description = $row['description'];
    $image = $row['image'];
    $created_at = date('d-M-Y');
    $invoice_no = time();
     $sqli="insert into orders ( `product_id`, `customer_id`, `quantity`, `payment`, `price`, `created_at`, `invoice_no`) values ('$pid',' $user_id','$quantity','pending','$totalprice',' $created_at','$invoice_no' );";
    $sqli.="UPDATE product SET quantity = quantity - $quantity WHERE product_id = '$pid'";
    mysqli_multi_query($conn,$sqli);
}
}

?>

<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Checkout</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
   input.inputBox{
        @apply p-1 border-2 border-black rounded-lg text-center
    }
        </style>
    </head>
<body class="bg-primary">
<?php include 'include/nav.php'; ?>
<div class="flex gap-10 mt-6 ml-20">
<div class=" gap-10 m-5">
<img src="../image/<?php echo $image; ?>" alt="Product Image" width="250" height="250">
<h2 class="mt-2"><?php echo $productName; ?></h2>
<p>Quantity: <?php echo $quantity; ?></p>
<p>Per Price: <?php echo $price; ?></p>
<p>Total price: <?php echo $totalprice; ?></p>
<p class="mb-7">About Shose: <?php echo $description; ?></p>

</div>
<div>
<form class="mt-12 flex justify-center gap-1 text-3xl font-semibold">
    cash:<input type="radio" name="show" value="cash" onclick="sh()" id="ca" class="mr-10 h-8 w-10">
   eSewa: <input type="radio" name="show" value="esewa" onclick="sh()" id="ep"class="h-8 w-10">
</form>

<div class="hidden bg-dimlight h-[380px] w-[270px]" id="cash">
  <?php     // Remove the specific product from the cart based on the product ID
   ?>
   <form action="cash.php" method="post" onsubmit="return orderConfirmation()" class="text-center">
      <h3 class="text-2xl font-semibold text-secondary m-2 pt-2">Place Your Order !</h3>
      <div class="m-2">
      <input type="hidden" value="<?php echo $pid; ?>" name="pid">
<input type="hidden" name="inv" value="<?php echo $invoice_no; ?>" placeholder="">
<input type="hidden" name="prc" value="<?php echo $price; ?>" placeholder="">
         <span>Your Name:</span>
         <input class="inputBox" type="text" name="name" id="uname-cash" required placeholder="Enter your name">
      </div>
      <div class="m-2">
         <span>Your Number:</span>
         <input type="tel" class="inputBox" name="phone" id="phn-cash" required placeholder="Enter your number">
      </div>
      <div class="m-2">
         <span>Your Email:</span>
         <input type="email" class="inputBox" name="email" id="eml-cash" required placeholder="Enter your email">
      </div>
      <div class="m-2">
         <span>Address:</span>
         <input type="text" class="inputBox" name="address" id="addrs-cash" required placeholder="Enter your address">
      </div>
      <input type="submit" name="csubmit" value="Order Now" class="border bg-btncolor p-1.5 mt-2 rounded-lg text-white text-xl " onclick="return validateCashForm()">
   </form>
</div>
<div class="hidden ml-20  bg-dimlight h-[380px] w-[270px]" id="epay">
   <form action="epay.php" method="post" onsubmit="return orderConfirmation() " class="text-center">
      <h3 class="text-2xl font-semibold text-secondary m-2 pt-2">Place Your Order</h3>
      <div class="m-2">
        <input type="hidden" name="inv" value="<?php echo $invoice_no;?>" placeholder="">
        <input type="hidden" name="prc" value="<?php echo $price;?>" placeholder="">
         <span>Your Name:</span>
         <input class="inputBox" type="text" name="name" id="uname-epay" required placeholder="Enter your name">
      </div>
      <div class="m-2">
         <span>Your Number:</span>
         <input type="tel" class="inputBox" name="phone" id="phn-epay" required placeholder="Enter your number">
      </div>
      <div class="m-2">
         <span>Your Email:</span>
         <input type="email" class="inputBox" name="email" id="eml-epay" required placeholder="Enter your email">
      </div>
      <div class="m-2">
         <span>Address:</span>
         <input type="text" class="inputBox" name="address" id="addrs-epay" required placeholder="Enter your address">
      </div>
      <input type="submit" name="csubmit" value="Order Now" class="border bg-btncolor p-1.5 mt-2 rounded-lg text-white text-xl " onclick="return validateEpayForm()">
   </form>
</div>
</div>
</div>

<script type="text/javascript">
   function sh() {
            if(document.getElementById('ca').checked){
                document.getElementById('cash').style.display='block';
                document.getElementById('epay').style.display='none';
            }
            else if(document.getElementById('ep').checked){
                document.getElementById('epay').style.display='block';
                document.getElementById('cash').style.display='none';
            }
            else{
                document.getElementById('epay').style.display='none';
                document.getElementById('cash').style.display='none'; 
            }
            }

            function validateCashForm() {
      var username = document.getElementById("uname-cash").value;
      var email = document.getElementById("eml-cash").value;
      var phone = document.getElementById("phn-cash").value;

      // Name should only contain letters
      var nameRegex = /^[A-Za-z\s]+$/;;
      if (!nameRegex.test(username)) {
         alert("Name should only contain letters.");
         return false;
      }

      // Name should contain at least 3 letters
      if (username.length < 3) {
         alert("Name should have at least 3 letters.");
         return false;
      }

      // Validate email format
      var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

      // Validate phone number length
      if (phone.length !== 10 || isNaN(phone)) {
         alert("Please enter a valid 10-digit phone number.");
         return false;
      }

      // Add any additional validations you need
   }

   function validateEpayForm() {
      var username = document.getElementById("uname-epay").value;
      var email = document.getElementById("eml-epay").value;
      var phone = document.getElementById("phn-epay").value;

      // Name should only contain letters
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

       // Validate email format
       var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

      // Validate phone number length
      if (phone.length !== 10 || isNaN(phone)) {
         alert("Please enter a valid 10-digit phone number.");
         return false;
      }

      // Add any additional validations you need
   }

   function orderConfirmation() {
        if (confirm("Do you really want to place the order?")) {
            return true; // If the user confirms, proceed with form submission
        } else {
            return false; // If the user cancels, do not submit the form
        }
    }
</script>

</body>
</html>









