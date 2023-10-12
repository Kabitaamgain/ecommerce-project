<?php
session_start();
include 'include/nav.php';
if (isset($_SESSION['Notlogin'])) {
  echo $_SESSION['Notlogin'];
  unset($_SESSION['Notlogin']);
} else {
  echo "";
}

$conn = mysqli_connect('localhost', 'root', '', 'shoestore') or die("Connection failed: " . mysqli_connect_error());
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['search'])) {
  $search = $_GET['search'];
  $sql = "SELECT * FROM product WHERE product_name LIKE '%$search%'";
} else {
  $sql = "SELECT * FROM product";
}

$result = mysqli_query($conn, $sql);
$sql1 = "SELECT * FROM cart";
$result1 = mysqli_query($conn, $sql1);
$quantity = mysqli_num_rows($result1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>website</title>
  <script src="../css/tailwindcss.css"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
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
      @apply text-2xl font-semibold text-secondary w-96 ml-64
    }
  </style>
</head>

<body class="bg-primary">
  <!-- navbar -->
  <!-- Rest of the code remains the same -->
  
  <!-- main section -->
  <div class="container flex gap-10 mt-2">
    <div class="mt-24 w-8/12">
      <!-- Rest of the code remains the same -->
    </div>
    <div class="w-10/12">
      <!-- Rest of the code remains the same -->
    </div>
  </div>

  <div>

    <div class="container grid grid-cols-3 gap-10">
      <?php
      if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
          $image = $rows['image'];
          $price = $rows['price'];
          $description = $rows['description'];
          $product_name = $rows['product_name'];
          $id = $rows['product_id'];
      ?>
          <form action="add_to_cart.php" method="get">
            <div class="w-[300px] mt-4">
              <img src="../image/<?php echo $image; ?>" alt="product_image" class="w-[350px] h-[350px] object-cover rounded-lg">
              <div class="bg-white p-4 text-center">
                <h3 class="text-lg font-bold mb-2"><?php echo $product_name; ?></h3>
                <i class="far fa-star text-light hover:text-golden"></i>
                <i class="far fa-star text-light hover:text-golden"></i>
                <i class="far fa-star text-light hover:text-golden"></i>
                <i class="far fa-star text-light hover:text-golden"></i>
                <i class="far fa-star text-light hover:text-golden"></i>
                <h4><?php echo $price; ?> USD</h4>
                <p class="mb-5"><?php echo $description; ?></p>
                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                <a  name="cart" class="border bg-btncolor p-3 rounded-lg text-white text-xl mt-10" href="../userpanel/checkout.php?id=<?php echo $id;?>">View More</a>
              </div>
            </div>
          </form>
      <?php
        }
      } else {
        echo '<h2>No products found.</h2>';
      }
      ?>
    </div>
  </div>


<!-- footer section -->
<div class="mt-56">
<?php 
include 'include/footer.php';
?>
</div>
  <!-- Scripts -->
  <!-- Rest of the code remains the same -->

</body>

</html>
