<?php 
$conn=mysqli_connect('localhost','root','','shoestore') or die("Connection error");
session_start();
include 'include/nav.php';
  $name=$_POST['name'];
  $inv=$_POST['inv'];
  $price=$_POST['prc'];
  $phone=$_POST['phone'];
  $email=$_POST['email'];
  $address=$_POST['address'];

    $sql1= "update orders set cname='$name',cphone='$phone',caddress='$address', email='$email', method='epay' where invoice_no='$inv'";
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>payment</title>

<script src="../css/tailwindcss.css"></script>
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

</head>
<body class="bg-[mintcream]">

<form action="https://uat.esewa.com.np/epay/main" method="POST">
                    <input value="<?php echo $price;?>" name="tAmt" type="hidden">
                    <input value="<?php echo $price;?>" name="amt" type="hidden">
                    <input value="0" name="txAmt" type="hidden">
                    <input value="0" name="psc" type="hidden">
                    <input value="0" name="pdc" type="hidden">
                    <input value="epay_payment" name="scd" type="hidden">
                    <input value="<?php echo $invoice;?>" name="pid" type="hidden">
                    <input value="http://localhost/ecommerce website/userpanel/esewa_payment_success.php" type="hidden" name="su">
                    <input value="http://localhost/ecommerce website/userpanel/esewa_payment_failed.php" type="hidden" name="fu">
                   <span class="text-3xl font-semibold ml-32 p-10">Pay With: <input type="image" src="../image/esewa.png" class="w-80 h-32  mx-10 mt-16"> </span>             
             </form>
             </body>
</html>