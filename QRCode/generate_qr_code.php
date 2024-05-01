<?php
// Include the QR code library
include "phpqrcode/qrlib.php";

// Function to generate QR code
function generateQRCode($order_id) {
    // Fetch order details from the database
    $servername = "localhost";
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $dbname = "vending_machine";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch order details
    $sql = "SELECT product_id, quantity FROM Order_Items WHERE order_id = '$order_id'";
    $result = $conn->query($sql);

    $order_details = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];
            $order_details[] = array("product_id" => $product_id, "quantity" => $quantity);
        }
    }

    // Close database connection
    $conn->close();

    // Generate QR code data
    $data_string = "OID:$order_id;"; // Format for Arduino parsing
    foreach ($order_details as $detail) {
        $product_id = $detail['product_id'];
        $quantity = $detail['quantity'];
        $data_string .= "PID:$product_id,QTY:$quantity;";
    }

    // Generate QR code
    ob_start();
    QRcode::png($data_string, null, QR_ECLEVEL_L, 10, 2);
    $qrCodeData = ob_get_contents();
    ob_end_clean();

    // Output the QR code image
    $output = '<br>';
    $output .= '<div style="text-align: center">';
    $output .= '<img src="data:image/png;base64,'.base64_encode($qrCodeData).'" alt="QR Code">';
    $output .= '</div>';

    // Output the QR code data
    $output .= '<br>';
    $output .= '<div>';
    $output .= '<h3>QR Code Data:</h3>';
    $output .= '<p>' . $data_string . '</p>';
    $output .= '</div>';

    // Output the print QR code button
    $output .= '<br>';
    $output .= '<button onclick="printQRCode()">Print QR Code</button>';

    return $output;
}
?>

<?php
// Get the order ID from the request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    echo generateQRCode($order_id); // Return the generated QR code
}
?>
