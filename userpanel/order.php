<?php
session_start();
include 'include/nav.php';

if (!isset($_SESSION['Email'])) {
    $_SESSION['Notlogin'] = "<script>alert('Please Login First')</script>";
    header("location: http://localhost/ecommerce website/home/index.php");
    exit();
}

$conn = mysqli_connect('localhost', 'root', '', 'shoestore') or die("Connection failed: " . mysqli_connect_error());

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];
        $sql = "SELECT * FROM product WHERE product_id='$product_id'";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) == 1) {
            $product = mysqli_fetch_assoc($result);
            $total = $product['price'];
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ecommerce website</title>
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
</head>
<body class="bg-primary">

    <div class="container flex gap-20 mt-10">
<div>
<img src="../image/<?php echo $product['image']?>" class="card-img-top" alt="..." style="width:250px; height: 300px;"> 
</div>
<div>
<h5 class="text-xl semibold"><?php echo $product['product_name'];?></h5>
                                <p class="card-text">Rs. <?php echo $product['price'];?></p>
                                <p class="card-text"><?php echo $product['description'];?></p>
                      <h3 class="mt-8 text-xl font-semibold">Pay With:</h3>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <form action="https://uat.esewa.com.np/epay/main" method="POST">
                                    <input value="<?php echo $total;?>" name="tAmt" type="hidden">
                                    <input value="<?php echo $total;?>" name="amt" type="hidden">
                                    <input value="0" name="txAmt" type="hidden">
                                    <input value="0" name="psc" type="hidden">
                                    <input value="0" name="pdc" type="hidden">
                                    <input value="epay_payment" name="scd" type="hidden">
                                    <input value="<?php echo $invoice_no;?>" name="pid" type="hidden">
                                    <input value="http://localhost/ecommerce website/userpanel/esewa_payment_success.php" type="hidden" name="su">
                                    <input value="http://localhost/ecommerce website/userpanel/esewa_payment_failed.php" type="hidden" name="fu">
                                    <li class="my-2"><input type="image" src="../image/esewa.png" class="w-48"></li>
                                </form>
                            </li>
                        </ul>  
</div>

    </div>
    
    <!-- footer section -->
</body>
</html>
