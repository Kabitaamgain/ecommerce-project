<?php
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
$conn = mysqli_connect('localhost', 'root', '', 'shoestore') or die("Connection error");

$sqli = "SELECT product_id FROM cart where user_id='$user_id'";
$result1 = mysqli_query($conn, $sqli);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ecommerce website</title>
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

button{ 
  @apply  border-2 my-3 mx-20 p-2 text-xl
}
table,tr,th,td{
        @apply border-2 px-2
        }
        </style>
</head>
<body class="bg-primary">
<div class="sticky top-0 bg-primary">
  <nav class="flex  justify-between shadow-md text-lg">
    <ul class="flex gap-20 py-5 container font-semibold ">
      <li class="hover:text-secondary"><a href="home.php">Home</a></li>
      <li class="hover:text-secondary"><a href="../home/aboutus.php">About</a></li>
      <li class="hover:text-secondary"><a href="contact.php">Contact</a></li>
      <li class="hover:text-secondary"><a href="myorder.php">Orders</a></li>
      <form action="../userpanel/categories.php" method="POST">
      <?php $sql="select * from categories" ;
        $result=mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
        ?>
        <select name="category" id="1" class="bg-primary" onchange="this.form.submit();">
          <option value="" disabled selected>Categories</option>
          <?php 
          while($rows=mysqli_fetch_assoc($result)){

          ?>
          <option value="<?php echo $rows['category_id'] ;?>"><?php echo $rows['category'];?></option>
       <?php } ?>
        </select>
       <?php } ?>
      </form>
      <li class="flex">
      <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
        <a href="../userpanel/cart.php"  class="flex">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
</svg> <span>(<?php echo $cart_rows_number; ?>)</span>
</a>

  </li>


    <ul class=" ml-28 font-semibold flex gap-16 pt-1">
    <ul class="flex">
      <li class="hover:text-secondary flex gap-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mt-1">
  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
</svg>
 <?php echo $_SESSION['uname']; ?></li>
      </ul>
      <li class="hover:text-secondary"><a href="../userpanel/logout.php">Logout</a></li>

    </ul>
  </nav>
</div>
    <div class="container mt-20">
        <?php
         $grand_total = 0;
       $sql="SELECT product.product_id, product.product_name, product.image, product.price, product.description, product.category_id, cart.product_id, cart.quantity, cart.user_id
       FROM product 
       INNER JOIN categories ON product.category_id=categories.category_id
       INNER JOIN cart ON product.product_id=cart.product_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result1) > 0) {
            if (mysqli_num_rows($result) > 0) {
                ?>
                <form action="../userpanel/order.php" method="post">
        <table>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Image</th>
                <th>quantity</th>
                <th>Price</th>
                <th>Description</th>
                <th>Category</th>
                <th colspan="2">Operation</th>
            </tr>
            <?php 
            while ($rows = mysqli_fetch_assoc($result)) {
                $pid = $rows['product_id'];
                mysqli_data_seek($result1, 0); // Reset the pointer of $result1 to the beginning
                while ($row = mysqli_fetch_assoc($result1)) {
                    if ($row['product_id'] == $pid) {
                      $sql1="select * from categories";
                      $result2=mysqli_query($conn ,$sql1);
                if(mysqli_num_rows($result2)>0){
                  while($rows1=mysqli_fetch_assoc($result2)){
                if($rows['category_id']==$rows1['category_id']){
                  $category=$rows1['category'];
                }
                }  
                }               
            ?>
            <tr>
                <td><?php echo $pid; ?></td>
                <td><?php echo $rows['product_name']; ?></td>
                <td><img src="../image/<?php echo $rows['image']; ?>" alt="Product Image" class="h-20 w-20"></td>
                <td><?php echo $rows['quantity']; ?></td>
                <td><?php echo $rows['quantity'] *$rows['price']; ?></td>
                <td><?php echo $rows['description']; ?></td>
                <td><?php echo $category; ?></td>
                <td> <a class="bg-btncolor text-white p-2 rounded-lg " type="submit" name="order_now" href="../userpanel/checkout.php?id=<?php echo $row['product_id'];?>&quantity=<?php echo $rows['quantity']; ?>   ">Checkout</a></td>
               <td><a  class="bg-red-400 text-white p-2 rounded-lg " href="../userpanel/deletecartproduct.php?id=<?php echo $rows['product_id']; ?>" onclick="return del()"> Remove </a></td>

            </tr>
            <?php 
          
                    }
                }
            }
            ?>
        </table>
        <?php 
            }
        }else{
            echo "<h1 class='text-xl flex items-center justify-center'>"."No data Found"."</h1>";
        }
        ?>
        </form>
    </div>
    <script type="text/javascript">


function del(){
if(confirm("Do you really want to delete")==true){
return true;
}else{
return false;
}
}
</script>
<!-- footer section -->
<div class="mt-80">
<?php 
include 'include/footer.php';
?>
</div>

</body>
</html>