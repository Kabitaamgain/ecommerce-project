<div class=" flex gap-20 bg-[mintcream] h-full">
<div>
<?php 
session_start();
include 'include/nav.php';
include 'rolecheck.php';
if (isset($_REQUEST['submit'])) {
  $product_name = $_REQUEST['productName'];
  $price = $_REQUEST['price'];
  $category = $_REQUEST['category'];
  $description = $_REQUEST['description'];
  $quantity = $_REQUEST['quantity'];
  // $image = $_REQUEST['image'];

  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    move_uploaded_file($file_tmp, '../image/' . $file_name);
    echo '<img src="../image/' . $file_name . '" alt="Uploaded Image">';
  }

  $sql = "insert into product(product_name,image,price, category_id,description,quantity) values ('$product_name', '$file_name', '$price','$category', '$description','$quantity')";
  if (mysqli_query($conn, $sql)) {
    header("location: http://localhost/ecommerce website/adminpanel/product.php");
	}
}
?>
</div>
<div>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
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
  @apply bg-white w-96 h-[570px] pl-8 py-4
}
label{
  @apply text-xl
}

button{ 
  @apply  border-2 my-3 mx-20 p-2 text-xl
}

        </style>
</head>
<body >
<div>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="mx-auto" onsubmit="return addproductvalidation()">
        <h3 class="text-xl font-semibold mb-5 text-center">Add New Product</h3>
        <label>Product Name</label>
        <input type="text" name="productName" id="pname" required>
        <label>Select image</label>
        <input type="file" name="image" id="img" required>
        <label>Price</label>
        <input type="text" name="price" id="prc" required>
        <label>Category</label> <br/>
        <?php 
        $sql = "SELECT * FROM categories";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        ?>
        <select name="category" id="categorySelect" class="border-2 border-black rounded-lg p-2 w-80 text-xl">
          <option value="" class="bg-primary" disabled selected>Categories</option>
          <?php 
          while ($rows = mysqli_fetch_assoc($result)) {
          ?>
          <option value="<?php echo $rows['category_id']; ?>"><?php echo $rows['category']; ?></option>
          <?php } ?>
        </select>
        <?php } ?><br/>
        <label>Quantity</label>
        <input type="number" name="quantity" required>
        <label>Description</label>
        <textarea name="description" id="description" required></textarea>
        <button type="submit" name="submit" class="bg-[#ebe8dd]">Add Product</button>
      </form>
      <?php if (isset($file_name)): ?>
        <img src="../image/<?php echo $file_name; ?>" alt="Uploaded Image">
      <?php endif; ?>
    </div>
  </div>
  <script>
    function addproductvalidation() {
      var productName = document.getElementById("pname").value;
      var image = document.getElementById("img").value;
      var price = document.getElementById("prc").value;
      var category = document.getElementById("categorySelect").value;
      var description = document.getElementById("description").value;

      var nameRegex = /^[A-Za-z]+$/;
      if (!nameRegex.test(productName)) {
        alert("Name should only contain letters.");
        return false;
      }
      if (productName.length < 3) {
        alert("Name should have at least 3 letters.");
        return false;
      }
      if (isNaN(price) || parseFloat(price) <= 0) {
        alert("Please enter a valid positive price.");
        return false;
      }
      if (image.trim() === "") {
        alert("Please select an image.");
        return false;
      }

      var allowedExtensions = ["jpg", "jpeg", "png", "gif"];
      var fileExtension = image.split('.').pop().toLowerCase();
      if (!allowedExtensions.includes(fileExtension)) {
        alert("Invalid image file. Allowed formats: jpg, jpeg, png, gif.");
        return false;
      }

      if (category === "") {
        alert("Please select a category.");
        return false;
      }
    }
  </script>

</body>

</html>










