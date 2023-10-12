<?php
session_start();
include 'include/nav.php';
$conn=mysqli_connect('localhost','root','','shoestore') or die("Connection error");
if(isset($_SESSION['Email'])){
  $user_id = $_SESSION['Id'];
} 
else{
  $user_id="";
}

if (isset($_GET['id'])) {
  $productId = $_GET['id'];

  // Perform a database query to fetch the product information based on the product ID
  $sql = "SELECT * FROM product WHERE product_id = $productId";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $productName = $row['product_name'];
    $price = $row['price'];
    $description = $row['description'];
    $image = $row['image'];

    ?>

    <!DOCTYPE html>
    <html lang="en">
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
    input.inputitem{
      @apply m-2 p-3 rounded-lg text-center
    }
    h2{
      @apply text-2xl font-semibold text-secondary m-2
    }
        </style>
    </head>
    <body class="bg-primary">
      <div class="flex gap-10 m-5">
        <div>
        <img src="../image/<?php echo $image; ?>" alt="Product Image" width="400" height="400">
        </div>
        <div>
          
<?php 
$s="select * from product where product_id='$productId'";
$r=mysqli_query($conn,$s);
$c=mysqli_num_rows($r);
if($c==1){
  $i=mysqli_fetch_assoc($r);
  $tp=$i['quantity'];
}
else{
  die("Out of stock");
}
?>
       
<h2><?php echo $productName; ?></h2>
<p>Price: <?php echo $price; ?></p>
<p class="mb-2"><?php echo $description; ?></p>
<form action="add_to_cart.php">
<p>quantity: <input type="number" min="1" max="5"<?php echo $tp;?>" name="product_quantity" value="1" class="bg-primary border-2 border-black rounded-lg text-center"> </p>
<span class="font-semibold"><?php if($tp==0 || $tp=='NULL'){
  echo "Out of stock";
}else{
  echo "We have only " .$tp. " products left";
}
  ?></span>
<input type="hidden" name="id" value="<?php echo $productId;?>">
<div class="mt-5">
  <?php if($tp==0 || $tp=='NULL'){
    $class="cursor-not-allowed";
    $href="#";
  }else{
    $class="cursor-pointer";
    $href="checkout.php?id=".$productId;
  }
  ?>  
  <?php if($tp==0 || $tp=='NULL'){
    ?>
<a href="<?php echo $href;?>" class="border bg-btncolor p-3 rounded-lg text-white text-xl  mx-5 <?php echo $class ;?>" > add_to_cart </a>
<?php } else{
  ?>
<input type="submit" name="submit" value="add_to_cart" class="border bg-btncolor p-3 rounded-lg text-white text-xl  mx-5 pointer-cursor" >
<?php } ?>
<a  name="cart" class="border bg-btncolor p-3 rounded-lg text-white text-xl  mx-5 <?php echo $class ;?>" href="<?php echo $href;?>" >Checkout</a>
</div>
</form>


           <!-- Rating Form -->
          
<?php 
$sql2="select * from orders where customer_id='$user_id' and product_id='$productId' and payment='completed'";
$result=mysqli_query($conn,$sql2);
if(mysqli_num_rows($result)>0){
?>

   <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" id="ratingForm" class="mb-5 w-56 mt-6">
    <fieldset>
      <legend> <h2 class="mt-6"> Rating and Review </h2></legend>
        <label for="rating">Rate this product:</label>
        <input type="hidden" id="productId" name="product_id" value="<?php echo $productId; ?>">
        <select name="rating" id="rating" type="rating" class="border-2 p-1.5 bg-primary">
            <option value="1">1 star</option>
            <option value="2">2 stars</option>
            <option value="3">3 stars</option>
            <option value="4">4 stars</option>
            <option value="5">5 stars</option>
        </select>

        <!-- Review Form -->
        <label for="review">Write a review:</label>
        <textarea name="review" id="review" rows="2" type="review"class="border-2 p-1.5 bg-primary"></textarea>
        <button class="bg-red-400 text-white py-1.5 px-3 m-2 rounded-lg ml-12" type="submit" name='submitreview'>Submit </button>
        </fieldset>
      </form>

 <?php } 
 $sqli1="select* from ratings inner join register on ratings.user_id= register.id where product_id='$productId'";
 $resulti1=mysqli_query($conn, $sqli1);
 if(mysqli_num_rows($resulti1)>0){

 
 ?>

 <div class="grid gap-10">
<?php 
while($rowsi1=mysqli_fetch_assoc($resulti1)){


?>
<div class="overflow-y-scroll bg-gray-100 text-black"><?php echo "Name: "; echo $rowsi1['userName'].'<br>'; echo "<p>". $rowsi1['review']."</p>";?></div>
<?php } ?>
 </div>
 <?php } ?>
    </body>
    </html>

    <?php
  }
}

if(isset($_POST['submitreview'])){
  $review=$_POST['review'];
  $sql3="insert into ratings (product_id, user_id, review ) values ('$productId', '$user_id','$review') ";
  if(mysqli_query($conn,$sql3)){
    echo "Thank you for review..";
  }
  else {
    echo 'Error: ' . mysqli_error($conn); // Display error message in case of query failure
  }
}
?>

