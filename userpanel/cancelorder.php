<?php
// Ensure that a product_id parameter is passed in the URL
if (isset($_GET['product_id'])) {
    // Get the product_id from the URL
    $product_id = $_GET['product_id'];

    // Your database connection code here (similar to your existing code)
    $conn = mysqli_connect('localhost', 'root', '', 'shoestore') or die("Connection error");

    // Check if the user is logged in and has the necessary privileges to cancel the order
    session_start();
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

    // Check if the order exists and belongs to the logged-in user
    $order_query = mysqli_query($conn, "SELECT * FROM orders WHERE product_id = '$product_id' AND customer_id = '$user_id'") or die('Query failed');
    if (mysqli_num_rows($order_query) > 0) {
        $fetch_order = mysqli_fetch_assoc($order_query);

        // Check if the order is in 'pending' payment status
        if ($fetch_order['payment'] === 'pending') {
            // Perform the cancellation logic here (you can update the 'payment' status)
            $update_query = mysqli_query($conn, "UPDATE orders SET payment = 'cancelled' WHERE product_id = '$product_id'") or die('Update query failed');

            // Check if the update was successful
            if ($update_query) {
                // Redirect back to the orders page with a success message
                header("Location: myorder.php");
                exit();
            } else {
                // Handle the case where the update fails
                echo "Failed to cancel the order.";
            }
        } else {
            // Handle the case where the order cannot be canceled (e.g., it's already paid)
            echo "Order cannot be canceled.";
        }
    } else {
        // Handle the case where the order does not exist or does not belong to the user
        echo "Order not found.";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Handle the case where 'product_id' is not set in the URL
    echo "Invalid request.";
}
?>
