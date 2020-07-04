<!--
#--------------------------------------------------------------------------#
# Filename        :  update_product.php                                    #
# Author          :  Lyka C. Casilao                                       #        
# Last Modified   :  July 2, 2020                                          #
# Honor Code      : This is my own work and I have not received any        #
#                   unauthorized help in completing this. I have not       #
#                   copied from my classmate, friend, nor any unauthorized #
#                   resource. I am well aware of the policies stipulated   #     
#                   in the handbook regarding academic dishonesty.         #
#                   If proven guilty, I won't be credited any              #
#                   points for this endeavor.                              #
#--------------------------------------------------------------------------#
-->

<?php
    $conn = new mysqli('localhost', 'lykacasilao', 'admin', 'cacti_database') ;
    if ($conn->connect_error)
        die("Connection Failed");
?>

<?php

    $prodname = "";
    $prodtype = "";
    $price = "";
    $stocks = "";
    $picture = "";
    $id = 0;
    $update = false;

    if ((isset($_POST['update'])!="")) {
        $id = $_POST['id'];
        $name = $_POST['prodname'];
        $type= $_POST['prodtype'];
        $price = $_POST['price'];
        $stocks = $_POST['stocks'];
        $picture = $_POST['picture'];

        if(!empty($name)&&!empty($type)){
            $sql = "UPDATE products SET prodname='$name', prodtype='$type', price='$price', stocks='$stocks', picture_location='$picture' WHERE product_code='$id'";

            if (mysqli_query($conn, $sql)){
                ?>
                <script>
                    alert('Successfully updated.');
                    window.location.href='product_admin.php?username=admin"';
                </script>
            <?php 
            } 
            else{
                ?>
                <script>
                    alert('Invalid.');
                    window.location.href='product_admin.php?username=admin"';
                </script>
            <?php 
            }
        } 
    }
?>