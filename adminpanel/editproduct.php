<div class="flex gap-40">
<div>
<?php
session_start();
include 'include/nav.php';
include 'rolecheck.php';

if (isset($_REQUEST['submit'])) {
    $product_name = $_REQUEST['productName'];
    $price = $_REQUEST['price'];
    $description = $_REQUEST['description'];
    $productId = $_REQUEST['productId'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
      $file_name = $_FILES['image']['name'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      move_uploaded_file($file_tmp, '../image/' . $file_name);
      echo '<img src="../image/' . $file_name . '" alt="Uploaded Image">';
    }
  

    $sql = "UPDATE product SET product_name='$product_name', image='$file_name', price='$price', description='$description' WHERE product_id='$productId'";
    if (mysqli_query($conn, $sql)) {
        header("location: http://localhost/ecommerce%20website/adminpanel/product.php");
    } else {
        echo "Unable to update";
    }
}

?>
</div>

<div>
<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
		formcolor:"#ebe8dd"
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
       h3{
      @apply text-2xl font-semibold text-secondary m-2
    }
    input[type="text"],
input[type="Number"],
textarea
{
  @apply px-4 py-2 rounded border-2 border-black w-80 mt-2 block text-xl 
}
input[type="file"]{
  @apply block px-4 py-2 block mt-2 text-xl mx-auto
}
form{
  @apply bg-formcolor w-96 h-[550px] pl-8 py-4 container my-10
}
label{
  @apply text-xl
}

button{ 
  @apply  border-2 my-3 mx-20 p-2 text-xl w-40
}
</style>
</head>
<body>
    <?php
    $id = $_REQUEST['id'];
    $sql = "SELECT product_id, product_name, image, price, description FROM product WHERE product_id='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($product = mysqli_fetch_assoc($result)) {
    ?>
            <form ction="<?php $_SERVER['PHP_SELF']; ?>"  method="post" enctype="multipart/form-data">
                <input type="hidden" name="productId" value="<?php echo $product['product_id']; ?>">
                <label>Product Name</label>
                <input type="text" name="productName" value="<?php echo $product['product_name']; ?>">
                <label>Image</label>
                <input type="file" name="image" value="<?php echo $product['image']; ?>">
                <label>Price</label>
                <input type="text" name="price" value="<?php echo $product['price']; ?>">
                <label>Description</label>
                <textarea name="description"><?php echo $product['description']; ?></textarea>
                <button type="submit" name="submit" class="bg-primary">Update Product</button>
            </form>
    <?php
        }
    }
    ?>
</div>
</div>

    <!-- footer section -->
<?php 
include 'include/footer.php';
?>
</body>

</html>