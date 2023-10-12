<?php
$conn = mysqli_connect('localhost', 'root', '', 'shoestore') or die("Connection failed: " . mysqli_connect_error());
    $productId = $_REQUEST['id'];
    $sqli="select * FROM cart where product_id='$productId'";
   $result=mysqli_query($conn,$sqli) or die("query failed");
    $row=mysqli_fetch_assoc($result);

    // Delete the product from the database based on the product ID
    unlink('../image/'.$row['image']);
    $sql = "DELETE FROM cart WHERE product_id = '$productId'";
    if (mysqli_query($conn, $sql)) {
        header("location: http://localhost/ecommerce%20website/userpanel/cart.php");
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
    }
?>