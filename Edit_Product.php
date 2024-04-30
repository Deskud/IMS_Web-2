<?php
    session_start();

    $user = ( $_SESSION['admins']);
    if(!isset($_SESSION['admins'])) header('location: Login.php');
     $user = $_SESSION['admins'];



    $id = $_GET['edit'];


    include 'PHP_Database/conne2.php';

    if(isset($_POST['Update'])){


        $product_name = $_POST['name'];
        $product_size = $_POST['size'];
        $product_price = $_POST['price'];
        $product_quantity = $_POST['quantity'];



        if(empty($product_name)|| empty($product_price)){
            $message[] = 'Please fill out the following';

        }
        else{
            $update = "UPDATE products SET product_name = '$product_name', product_size = '$product_size', price = '$product_price', quantity = '$product_quantity' 
            WHERE product_id = $id ";
            $adding = mysqli_query($dbADD, $update);

            if($adding){// If the addition of the product is successfull say this
                $message[] = 'Product added successfully';

            }
            else{ //Check errors
                $message[] = 'Bruh';

            }
        }
    };



?>
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
                        <?php
                             if(isset($message)){
                                foreach($message as $message){
                                    echo'<span class="message">'.$message.'</span>';
                        
                                }
                            }
                        ?>
                        <div class="ProdUpdate">
                            <div class="AddProd">

                                <?php

                                $select = mysqli_query($dbADD, "SELECT * FROM products WHERE product_id= $id");
                                while($row = mysqli_fetch_assoc($select)){


                            
                                ?>
                                <form action="" method="post" enctype='multipart/form-data'>
                                    <h1 class="ProductsTitle">Update Product</h1>

                                        <select class="boxprod" name="name">
                                            <option selected>Select Uniform Type</option>
                                            <option value="Male Uniform">Male Uniform</option>
                                            <option value="Female Uniform">Female Uniform</option>
                                            <option value="Pants">Pants</option>
                                            <option value="PE Shirt">PE Shirt</option>
                                            <option value="Jogging Pants">Jogging Pants</option>
                                            <option value="College Shirt">College Shirt</option>
                                        </select>

                                        <select class="selectsize" name="size">
                                        <option selected>Select Uniform Size</option>
                                        <option value="Small">Small</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Large">Large</option>
                                        <option value="Extra Large">Extra Large</option>
                                        </select>


                                        <input type="number" placeholder="Enter Price" name="price" class="boxprice" value="<?php $row['price'];?>">
                                        <input type="number" placeholder="Enter Quantity" name="quantity" class="boxquantity" value="<?php $row['quantity'];?>">

                                    <input type="submit" name="Update" class="Addbutton" value="Update Product">
                                    <a href="Products.php" class="GoBack"><i class="fa-solid fa-arrow-left"></i></a>
                                </form>

                                <?php };?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>