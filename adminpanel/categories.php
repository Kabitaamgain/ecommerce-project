<div class="flex gap-60 bg-[mintcream] h-full">
<div>
<?php 
session_start();
include 'include/nav.php';
include 'rolecheck.php';
$conn = mysqli_connect('localhost', 'root', '', 'shoestore') or die("Connection failed: " . mysqli_connect_error());
if(isset($_POST['add'])){
    $category=$_POST['category'];
    $sql="Insert into categories (category) values ('$category')";
    $result=mysqli_query($conn, $sql);
    if($result){
        echo'Category successfully added !';
    }
    else{
        echo'error occur';
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
</head>
<body class="bg-[mintcream]">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="text-center">
        <input type="text" name="category"  class="block border-2 mx-auto mt-36 border-black rounded-lg p-2" required>
        <button name="add" class="p-2 rounded-lg bg-[#DFC98A] my-4">Add category </button>
</form>
</div>
</div>
</body>
</html>