<?php
$conn = mysqli_connect('localhost', 'root', '', 'shoestore') or die("Connection error");

$sqli = "SELECT product_id FROM cart";
$result1 = mysqli_query($conn, $sqli);
$totalPrice = 0; 
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
        @apply border-2
        }
        </style>
</head>
<body class="bg-primary">
    <div class="container mt-20">
        <?php 
        $sql = "SELECT * FROM product";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result1) > 0) {
            if (mysqli_num_rows($result) > 0) {
        ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Image</th>
                <th>Price</th>
                <th>Description</th>
                <th>Category</th>
            </tr>
            <?php 
            while ($rows = mysqli_fetch_assoc($result)) {
                $pid = $rows['product_id'];
                mysqli_data_seek($result1, 0); // Reset the pointer of $result1 to the beginning
                while ($row = mysqli_fetch_assoc($result1)) {
                    if ($row['product_id'] == $pid) {
                      $totalPrice += $rows['price']; 
                    
            ?>
            <tr>

                <td><?php echo $pid; ?></td>
                <td><?php echo $rows['product_name']; ?></td>
                <td><?php echo $rows['image']; ?></td>
                <td><?php echo $rows['price']; ?></td>
                <td><?php echo $rows['description']; ?></td>
                <td><?php echo $rows['category']; ?></td>
            </tr>
            <?php 

                    }
                }
            }
            ?>
        </table>
        <?php 
        echo "Grand Total Price: " . $totalPrice; 
            }
        }
        ?>
        <button class="bg-secondary">Buy Now </button>
    </div>
</body>
</html>
