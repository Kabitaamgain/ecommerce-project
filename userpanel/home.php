<?php 

$conn = mysqli_connect('localhost', 'root', '', 'shoestore') or die("connection failed: " . mysqli_connect_error());
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
session_start();
include 'include/nav.php';
if(!isset($_SESSION['Email'])){
  header("location: http://localhost/ecommerce website/home/index.php");
  }
  // Successfully added to cart
if(isset($_SESSION['suscadd'])){
  echo $_SESSION['suscadd'];
  unset($_SESSION['suscadd']);
}


// if already added in cart
if(isset($_SESSION['aadded'])){
  echo $_SESSION['aadded'];
  unset($_SESSION['aadded']);
}
 
// if($_SESSION['success']){
//   echo $_SESSION['success'];
//   unset($_SESSION['success']);
// }
$sql = "SELECT * FROM product";
$result1 = mysqli_query($conn, $sql);
$sql1="select * from cart";
$result2=mysqli_query($conn, $sql1);
$quantity=mysqli_num_rows($result1);

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
 

<script type="text/javascript" src="../js/script.js"></script>

  <!-- main section -->
  <!-- <div class="container flex gap-10 mt-12">
    <div class="mt-24 w-8/12">
      <h1>SHOES <br> COLLECTION</h1>
      <h2 class="text-2xl text-secondary italic mt-5">Latest & Stylish Shoes for Men & Women in Fashion</h2>
      <button class="bg-tertiory p-2 my-2 mx-10 rounded-2xl text-white font-semibold hover:bg-secondary">CHECKOUT <i
          class="fa fa-arrow-right"></i></button>
    </div>
    <div class="w-10/12">
      <img src="../image/shose.jpg">
    </div>
  </div> -->



 
<!-- top-selling -->
<?php 
$sql = mysqli_query($conn, "SELECT product_id, count(product_id)
                           FROM orders 
                           GROUP BY product_id
                           ORDER BY count(product_id) DESC LIMIT 3");
?>
<h1 class="text-center mt-16 mb-10">TOP SELLING</h1>
<div class="container grid grid-cols-3 gap-10 ">
  <?php
  while ($result = mysqli_fetch_assoc($sql)) {
    $pid = $result['product_id'];
    $sqli = mysqli_query($conn, "SELECT * FROM product WHERE product_id= '$pid'");
    while ($resulti = mysqli_fetch_assoc($sqli)) {
      $image = $resulti['image'];
      $product_id = $resulti['product_id'];
      $product_name = $resulti['product_name'];
      $price = $resulti['price'];
      $description = $resulti['description'];
  ?>
      <form action="add_to_cart.php" method="get">
        <div class="w-[300px] mt-4">
          <img src="../image/<?php echo $image; ?>" class="w-full h-80 object-cover">
          <div class="discription">
            <h4><?php echo $product_name; ?></h4>
            <i class="fa fa-star text-light hover:text-golden"></i>
            <i class="fa fa-star text-light hover:text-golden"></i>
            <i class="fa fa-star text-light hover:text-golden"></i>
            <i class="fa fa-star text-light hover:text-golden"></i>
            <i class="fa fa-star text-light hover:text-golden"></i>
            <p>price: Rs.<?php echo $price; ?></p>
            <p class="mb-5"><?php echo $description; ?></p>
            <input type="hidden" name="product_id" value="<?php echo $id; ?>">
            <a name="cart" class="border bg-btncolor p-3 rounded-lg text-white text-xl mt-10" href="../userpanel/detail.php?id=<?php echo $pid; ?>">View More</a>
          </div>
        </div>
      </form>
  <?php
    }
  }
  ?>
</div>
</div>





  <!-- featured section -->
  <div>
  <h1 class=" text-center mt-16 mb-10">Featured Product</h1>
  <div class="container grid grid-cols-3 gap-10">

<?php 
$count=0;
if (mysqli_num_rows($result1) > 0) {
  while ($rows = mysqli_fetch_assoc($result1)) {
    $count++;
    $image = $rows['image'];
    $price = $rows['price'];
    $description = $rows['description'];
    $product_name=$rows['product_name'];
    $id=$rows['product_id'];
   ?>
     <form action="add_to_cart.php" method="get">
   <div class="w-[300px] mt-4">
    <img src="../image/<?php echo  $image ;?>" class="w-full h-80 object-cover">
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
  <h1 class=" text-center mt-16 mb-10">All Products</h1>
  <div class="container grid grid-cols-3 gap-10">

<?php 
$count=0;
if (mysqli_num_rows($result1) > 0) {
  while ($rows = mysqli_fetch_assoc($result1)) {
    $count++;
    $image = $rows['image'];
    $price = $rows['price'];
    $description = $rows['description'];
    $product_name=$rows['product_name'];
    $id=$rows['product_id'];
   ?>
     <form action="add_to_cart.php" method="get">
   <div class="w-[300px] mt-4">
    <img src="../image/<?php echo  $image ;?>" class="w-full h-80 object-cover">
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
<?php 
include 'include/footer.php';
?>
</body>
</html>