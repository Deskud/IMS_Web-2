<?php
    session_start();

    $user = ( $_SESSION['admins']);
    if(!isset($_SESSION['admins'])) header('location: Login.php');
     $user = $_SESSION['admins'];

?>
<!-- sender.php -->
<!DOCTYPE html>
<html>
<head>
    <title> Vending Machine IMS </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/IMSstyle.css">
    <script src="https://kit.fontawesome.com/883b8ee9d9.js" crossorigin="anonymous"></script>
</head>
<body id="DashboardBG">
    <div id="dashboardMainContainer">
        <?php include ('Parts/dash_sidebar.php')?>
        <div class="dashboardContent_Container" id="dashboardContent_Container">
        <?php include ('Parts/dash_topnav.php')?>
            <div class="dashboardContent">
                <div class="dashboardContent_Main">
                    <div class="qrcode_container">
                        <h2 id="qrcode_h2">Generate QR Code</h2><br>
                        <form id="generateQRForm">
                            <input type="text" class="input_order_id" id="order_id" name="order_id" placeholder="Enter Order ID">
                            <button type="submit" class="generate_button" id="generate_button">Generate QR Code</button>
                        </form>
                        <div id="qr_code_container"></div> <!-- Container to display QR code -->
                    </div>                        
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('generateQRForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            var order_id = document.getElementById('order_id').value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'QRCode/generate_qr_code.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        document.getElementById('qr_code_container').innerHTML = xhr.responseText; // Update container with response
                    } else {
                        alert('Error: ' + xhr.status);
                    }
                }
            };
            xhr.send('order_id=' + order_id);
        });
        function printQRCode() {
            // Placeholder function for printing QR code
            // This function will be replaced with actual printing logic
            alert("Printing QR Code...");
        }
    </script>
</body>
</html>
