<?php
// require 'PHP_Database/conne.php';
$servername = 'localhost';
$username = 'root';
$dbname = 'vending_machine';
$password = '';

$allData = "";


$datahistory = new mysqli($servername, $username, $password, $dbname);

// $query = "SELECT* FROM product"; //"product" pangalan ng database table

$result = $datahistory->query("SELECT*FROM transactions");

while($data = $result->fetch_assoc())
    $allData .= $data['transaction_id'].','. $data['order_id'].','. $data['customer_id'].','. $data['total_amount'].','. $data['transaction_date']."\n";

    $response = "data:text/csv;charset=utf-8 ,transaction_id,order_id,customer_id,total_amount,transaction_date\n";
    $response .= $allData;
   
?>
<div>

<button id= "hisdownl">
    
    <?php
        echo '<a href = "'.$response.'" download="PurchaseHistoryUniform.csv">Download</a>'; 
    ?>
    
</button>

</div>

<div class = "purchaseHistory">
        <table>
            <tr>
                 <th>Transaction ID</th>
                 <th>Order ID</th>
                 <th>Customer ID</th>
                 <th>Total Amount</th>
                 <th>Transaction Date</th>
            </tr>
            <tr>
                <?php
                foreach($result as $row)
                {
                    ?>
                        <td><?php echo $row['transaction_id'] ?></td>
                        <td><?php echo $row['order_id'] ?></td>
                        <td><?php echo $row['customer_id'] ?></td>
                        <td><?php echo $row['total_amount'] ?></td>
                        <td><?php echo $row['transaction_date'] ?></td>
                    </tr>
                    <?php
                }
                ?>
           
        </table>
 </div>
 

