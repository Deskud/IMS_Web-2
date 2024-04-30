<?php
   
    include 'PHP_Database/conne2.php';

    if(isset($_POST['Add'])){


        $product_name = $_POST['name'];
        $product_size = $_POST['size'];
        $product_price = $_POST['price'];
        $product_quantity = $_POST['quantity'];



        if(empty($product_name)|| empty($product_price)){
            $message[] = 'Please fill out the following';

        }
        else{
            $insert = "INSERT INTO products(product_name, product_size, price, quantity)
                        VALUES('$product_name', '$product_size ', '$product_price', '$product_quantity')"; 

            $adding = mysqli_query($dbADD, $insert);

            if($adding){// If the addition of the product is successfull say this
                $message[] = 'Product added successfully';

            }
            else{ //Check errors
                $message[] = 'Bruh';

            }
        }
    };

    //Shows error message 
    if(isset($message)){
        foreach($message as $message){
            echo'<span class="message">'.$message.'</span>';

        }
    } 

    //Deletes the data from table and the database. Basis is id/product_id
    if(isset($_GET['delete'])){ 
        $id = $_GET['delete'];
        mysqli_query($dbADD, "DELETE FROM products WHERE product_id = $id");
        header('location:Products.php');

    }
?>



<div class=Product_container>
    <div class="AddProd">
        <form action="" method="post" enctype='multipart/form-data'>
            <h1 class="ProductsTitle">Add Products</h1>

            <!-- <input type="text" placeholder="Enter Product" name="name" class="boxprod"> -->

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


                <input type="number" placeholder="Enter Price" name="price" class="boxprice">
                <input type="number" placeholder="Enter Quantity" name="quantity" class="boxquantity">

            <input type="submit" name="Add" class="Addbutton" value="Add Product">
        </form>
       
    </div>
</div>




<?php

$select = mysqli_query($dbADD, "SELECT * FROM products");
?>


<div class= "Productaddtable">
    <table class="display_added_prod">
        <tr>
            <td>Product Id</td>
            <td>Product</td>
            <td>Size</td>
            <td>Price</td>
            <td>Quantity</td>
            <td colspan="2">Action</td>
        </tr>

        <?php while($row = mysqli_fetch_assoc($select)){ ?>     
            <tr>
                <td><?php echo $row['product_id'] ?></td>
                <td><?php echo $row['product_name'] ?></td>
                <td><?php echo $row['product_size'] ?></td>
                <td>P<?php echo $row['price'] ?></td>
                <td><?php echo $row['quantity'] ?></td>
                <td>
                    <a href="Edit_Product.php?edit=<?php echo $row['product_id'];?>"class="btnEdit"><i class="fa-solid fa-pen-to-square"></i>Edit</i></a>
                    <a href="Products.php?delete=<?php echo $row['product_id'];?>"class="btnEdit"><i class="fa-solid fa-trash"></i>Delete</i></a>
                </td>
            
            </tr>
    <?php };?>
    </table>

</div>







