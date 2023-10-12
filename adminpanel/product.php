<div class="flex gap-10 h-full bg-primary">
<div>
<?php  
session_start();
include 'include/nav.php';
include 'rolecheck.php';
$sql="SELECT product.product_id, product.product_name, product.image, product.price, product.description, product.category_id
FROM product 
INNER JOIN categories ON product.category_id=categories.category_id;";
$result=mysqli_query($conn ,$sql);
if(mysqli_num_rows($result)>0){
?>
</div>
<div>
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
  @apply bg-white w-96 h-[450px] pl-8 py-4
}
label{
  @apply text-xl
}

button{ 
  @apply  border-2 my-3 mx-20 p-2 text-xl
}
table,tr,th,td{
        @apply border-2 px-2
        }
        </style>
</head>

<body class="bg-primary">
<script type="text/javascript" src="../js/script.js"></script>
  <div>
    <h3 class="text-xl font-semibold mb-5 text-center">Existing Products</h3>
    <table class="mr-4">
      <tr>
        <th>product_id</th>
        <th>Product_name</th>
        <th>image</th>
        <th>price</th>
        <th>category</th>
        <th>description</th>
        <th colspan="2">Operation</th>
      </tr>
     <?php
     while($rows=mysqli_fetch_assoc($result)){
      $sql1="select * from categories";
      $result1=mysqli_query($conn ,$sql1);
if(mysqli_num_rows($result1)>0){
  while($rows1=mysqli_fetch_assoc($result1)){
if($rows['category_id']==$rows1['category_id']){
  $category=$rows1['category'];
}
}  
}
?>
      <tr>
        <td><?php echo "$rows[product_id]";?></td>
        <td><?php echo "$rows[product_name]";?></td>
        <td><img src="../image/<?php echo $rows['image']; ?>" alt="Product Image" width="100"></td>
        <td><?php echo "$rows[price]";?></td>
        <td><?php echo $category;?></td>
        <td><?php echo "$rows[description]";?></td>
        <td><a class=" bg-btncolor text-white p-2 rounded-lg" href="editproduct.php?id=<?php echo $rows['product_id']; ?>">Edit</a></td>
        <td><a class=" bg-red-400 text-white p-2 rounded-lg " href="deleteproduct.php?id=<?php echo $rows['product_id']; ?>" onclick="return del()"> Delete </a></td>
      </tr>
      <?php } ?>
    </table>
    <?php } ?>
    </div>
    <div class="flex justify-center">
    <button class="bg-btncolor rounded-lg p-2 m-2 h-10 mt-10" ><a href="add_product.php">Add product</a></button>
     </div>
     </div>
      <script type="text/javascript" src="../js/script.js"></script>
      <script type="text/javascript">
	function del(){
if(confirm("Do you really want to delete")==true){
return true;
}else{
return false;
}
}
</script>
</div>
</div>
<!-- footer section -->

</body> 
</html>