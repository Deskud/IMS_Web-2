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
            // Create a new window to display the printable content
            var printableContent = document.getElementById('qr_code_container').innerHTML;
            var newWindow = window.open('', '_blank');
            
            // Write the printable content to the new window
            newWindow.document.open();
            newWindow.document.write('<html><head><title>QR Code</title></head><body>');
            newWindow.document.write(printableContent);
            newWindow.document.write('</body></html>');
           
            newWindow.document.close();
            
            // Call the print function after a slight delay to ensure the content is loaded
            setTimeout(function() {
                newWindow.print();
            }, 1000);
        }
    </script>
</body>
</html>
