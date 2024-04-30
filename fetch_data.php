<?php
// Establish MySQL database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "vending_machine"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT product_name, product_size, price, quantity FROM products";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["product_name"]."</td>";
        echo "<td>".$row["product_size"]."</td>";
        echo "<td>".$row["price"]."</td>";
        echo "<td>".$row["quantity"]."</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
