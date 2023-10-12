<?php
session_start();
// Assuming you are using PHP
$conn = mysqli_connect('localhost', 'root', '', 'shoestore') or die("Connection error");
$product_id = mysqli_real_escape_string($conn, $_SESSION["product_id"]);
$invoice_no = mysqli_real_escape_string($conn, $_SESSION["invoice_no"]);

$user_id = $_SESSION['Id'];

if (isset($_REQUEST['oid']) && isset($_REQUEST['amt']) && isset($_REQUEST['refId'])) {
    $sql = "SELECT * FROM orders WHERE customer_id = '$user_id' and product_id='$product_id' and invoice_no='$invoice_no'";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $order = mysqli_fetch_assoc($result);
            $url = "https://uat.esewa.com.np/epay/transrec";

            $data = [
                'amt' => $order['price'],
                'rid' => $_REQUEST['refId'],
                'pid' => $order['invoice_no'],
                'scd' => 'epay_payment'
            ];

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);

            if ($response === false) {
                echo "cURL Error: " . curl_error($curl); // Debugging: Display cURL errors
            } else {
                $response_code = get_xml_node_value('response_code', $response);

                if (trim($response_code) == 'Success') {
                    $sql = "UPDATE orders SET payment='complete' WHERE customer_id='$user_id' and product_id='$product_id'";
                    if (mysqli_query($conn, $sql)) {
                        // Delete the product from the cart
                        $deleteQuery = "DELETE FROM cart WHERE user_id='$user_id' AND product_id='$product_id'";
                        if (mysqli_query($conn, $deleteQuery)) {
                            // Redirect to success page
                            header('location: http://localhost/ecommerce website/userpanel/success.php');
                            exit();
                        } else {
                            echo "Failed to delete product from the cart: " . mysqli_error($conn);
                        }
                    } else {
                        echo "Failed to update order payment status: " . mysqli_error($conn);
                    }
                } else {
                    echo "Payment not successful. Response code: " . $response_code; // Debugging: Display response code
                }
            }
            curl_close($curl);
        } else {
            echo "Order not found or you don't have permission to update payment status.";
        }
    } else {
        echo "Query failed: " . mysqli_error($conn); // Debugging: Display query error
    }
}

function get_xml_node_value($node, $xml) {
    if ($xml == false) {
        return false;
    }
    $found = preg_match('#<'.$node.'(?:\s+[^>]+)?>(.*?)'.'</'.$node.'>#s', $xml, $matches);
    if ($found != false) {
        return $matches[1];
    }
    return false;
}
?>
