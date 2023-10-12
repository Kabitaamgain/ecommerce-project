
<?php
include 'rolecheck.php';
    $productId = $_REQUEST['id'];
    $sqli="select * FROM product where product_id='$productId'";
   $result=mysqli_query($conn,$sqli) or die("query failed");
    $row=mysqli_fetch_assoc($result);

    // Delete the product from the database based on the product ID
    unlink('../image/'.$row['image']);
    $sql = "DELETE FROM product WHERE product_id = '$productId'";
    if (mysqli_query($conn, $sql)) {
        header("location: http://localhost/ecommerce%20website/adminpanel/product.php");
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
    }
?>