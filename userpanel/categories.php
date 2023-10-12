<?php 
session_start();
include 'include/nav.php';
if(isset($_SESSION['Notlogin'])){
	echo $_SESSION['Notlogin'];
	unset($_SESSION['Notlogin']);
}else{
	echo "";
}
$conn = mysqli_connect('localhost', 'root', '', 'shoestore') or die("connection failed: " . mysqli_connect_error());

  $selected_category = $_POST['category'];
  // Fetch products based on selected category
  $sql = "SELECT * FROM product WHERE category_id = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "i", $selected_category);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
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

<div>
  <div class="container grid grid-cols-3 gap-10">
    <?php
    if (isset($result) && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $image = $row['image'];
            $price = $row['price'];
            $description = $row['description'];
            $product_name = $row['product_name'];
            $id = $row['product_id'];
            ?>
            <div class="w-[300px] mt-4">
              <img src="../image/<?php echo $image; ?>" class="w-full h-80 object-cover">
              <div class="discription">
                <h4><?php echo $product_name; ?></h4>
                <!-- Star ratings here -->
                <p>Price: Rs.<?php echo $price; ?></p>
                <p class="mb-5"><?php echo $description; ?></p>
                <a name="cart" class="border bg-btncolor p-3 rounded-lg text-white text-xl mt-10" href="../userpanel/detail.php?id=<?php echo $id; ?>">View More</a>
              </div>
            </div>
            <?php
        }
    } else {
        echo "<p class='text-center'>No products found for the selected category.</p>";
    }
    ?>
  </div>
</div>
  </body>
  </html>