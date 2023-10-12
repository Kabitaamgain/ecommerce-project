<?php
$conn=mysqli_connect('localhost','root','','shoestore') or die("Connection error");
session_start();

include '../userpanel/include/nav.php';
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Your Orders</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Tailwind CSS CDN link -->
   <script src="../css/tailwindcss.css"></script>
   

   <style>
      /* Add your custom styles here */
   </style>
</head>
<body>

<div class="heading bg-gray-500 h-20 p-5 mt-6">
      <h3 class="text-2xl font-bold text-center uppercase text-white">Your Orders</h3>
   </div>

   <section class="">
      <h1 class="title text-2xl font-bold text-center uppercase mt-4 mb-4"> Orders</h1>

      <div class="container mx-auto">
         <table class="table-auto mx-auto">
            <tr>
               <th class="px-2 py-2 bg-gray-700 text-white">Order Date</th>
               <th class="px-2 py-2 bg-gray-700 text-white">Quantity</th>
               <th class="px-2 py-2 bg-gray-700 text-white">Name</th>
               <th class="px-2 py-2 bg-gray-700 text-white">Number</th>
               <th class="px-2 py-2 bg-gray-700 text-white">Email</th>
               <th class="px-2 py-2 bg-gray-700 text-white">Address</th>
               <th class="px-2 py-2 bg-gray-700 text-white">Payment Method</th>
               <th class="px-2 py-2 bg-gray-700 text-white">Total Price</th>
               <th class="px-2 py-2 bg-gray-700 text-white">Payment Status</th>
               <th class="px-2 py-2 bg-gray-700 text-white">Action</th>
            </tr>
            <tbody>
               <?php
               $order_query = mysqli_query($conn, "SELECT * FROM orders WHERE customer_id = '$user_id'") or die('query failed');
               if (mysqli_num_rows($order_query) > 0) {
                  while ($fetch_orders = mysqli_fetch_assoc($order_query)) {
               ?>
                     <tr>
                        <td class="border px-2 py-2"><?php echo $fetch_orders['created_at']; ?></td>
                        <td class="border px-2 py-2"><?php echo $fetch_orders['quantity']; ?></td>
                        <td class="border px-2 py-2"><?php echo $fetch_orders['cname']; ?></td>
                        <td class="border px-2 py-2"><?php echo $fetch_orders['cphone']; ?></td>
                        <td class="border px-2 py-2"><?php echo $fetch_orders['email']; ?></td>
                        <td class="border px-2 py-2"><?php echo $fetch_orders['caddress']; ?></td>
                        <td class="border px-2 py-2"><?php echo $fetch_orders['method']; ?></td>
                        <td class="border px-2 py-2">Rs<?php echo $fetch_orders['price']; ?>/-</td>
                        <td class="border px-2 py-2">
                        <span style="color:<?php
        if ($fetch_orders['payment'] === 'pending') {
            echo 'blue';
        } elseif ($fetch_orders['payment'] === 'complete') {
            echo 'green';
        } else {
            echo 'red';
        }
    ?>">
        <?php echo $fetch_orders['payment']; ?>
    </span>
                        </td>
                        <td class="border px-4 py-2">
                           <?php if ($fetch_orders['payment'] === 'pending') { ?>
                              <a class="bg-[#DFC98A] text-white p-2 rounded-lg " href="cancelorder.php?product_id=<?php echo urlencode($fetch_orders['product_id']); ?>">Cancel Order</a>
                           <?php } else { ?>
                              <p>Order can't be canceled.</p>
                           <?php } ?>

                         <?php  if (isset($_GET['status'])) {
              $status = $_GET['payment'];

           // Display a message based on the status
               if ($status === 'cancelled') {
           echo '<p class="text-green-500">Order has been canceled successfully.</p>';
    }
}
?>
                        </td>
                     </tr>
               <?php
                  }
               } else {
                  echo '<tr><td class="border px-4 py-2" colspan="10">No orders placed yet!</td></tr>';
               }
               ?>
            </tbody>
         </table>
      </div>
   </section>
<!-- custom js file link -->
<script src="js/script.js"></script>

</body>
</html>