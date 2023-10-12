<?php
session_start();
// include 'include/nav.php';
$conn = mysqli_connect('localhost', 'root', '', 'shoestore') or die("Connection error");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['type'])) {
        $type = $_POST['type'];

        if ($type === 'rating') {
            if (isset($_POST['rating']) && is_numeric($_POST['rating'])) {
                $ratingValue = $_POST['rating'];
                $productId = $_POST['product_id'];
                $userId = $_SESSION['id'];

                // Insert the rating into the database
                $query = "INSERT INTO rating (product_id, user_id, rating_value) VALUES ($productId, $userId, $ratingValue)";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    echo "Thank you for your rating!";
                } else {
                    echo "Failed to submit rating.";
                }
            } else {
                echo "Invalid rating value.";
            }
        } elseif ($type === 'review') {
            if (isset($_POST['review']) && !empty($_POST['review'])) {
                $reviewText = mysqli_real_escape_string($conn, $_POST['review']);
                $productId = $_POST['product_id'];
                $userId = $_SESSION['id'];

                // Insert the review into the database
                $query = "INSERT INTO rating (product_id, user_id, review) VALUES ($productId, $userId, '$reviewText')";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    echo "Thank you for your review!";
                } else {
                    echo "Failed to submit review.";
                }
            } else {
                echo "Review text cannot be empty.";
            }
        } else {
            echo "Invalid feedback type.";
        }
    } else {
        echo "Feedback type not provided.";
    }
}
?>


