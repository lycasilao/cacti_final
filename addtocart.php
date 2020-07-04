<!--
#--------------------------------------------------------------------------#
# Filename        :  addtocart.php                                         #
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
    $code = $_GET['id'];
    $user = $_GET['username'];

    $sql = ("SELECT *  FROM products WHERE product_code= $code");
    $result = mysqli_query($conn, $sql);
    $n = mysqli_fetch_array($result);
        $prodname = $n['prodname'];
        $prodtype= $n['prodtype'];
        $price = $n['price'];
        $stock = $n['stocks'];
        $picture = $n['picture_location'];

        $stockup = $stock - 1;
        
        $sql = ("UPDATE products SET prodname='$prodname',  prodtype='$prodtype', price='$price', stocks='$stockup', picture_location = '$picture'  WHERE product_code= $code");
        mysqli_query($conn, $sql);        

        $sql = "SELECT user_id  FROM users WHERE username= '$user'";
        $result = mysqli_query($conn, $sql);
        $n = mysqli_fetch_array($result);
            $userid = $n['user_id'];

        $sql = "SELECT cart_id, quantity, price  FROM cart WHERE prodname= '$prodname' and user_id= $userid";
        $result = mysqli_query($conn, $sql);
            $n = mysqli_fetch_array($result);
            $cartid = $n['cart_id'];     
            $quantity = $n['quantity'];  
            $priceold = $n['price'];   

            $quan = $quantity + 1;
            $total = $priceold + $price;
                
        if(!empty($cartid)){
            $sql = "UPDATE cart SET prodname='$prodname', price='$total', quantity='$quan', user_id = '$userid', picture_location = '$picture'  WHERE cart_id='$cartid'";
        }
        else{
            $sql = "INSERT into cart(cart_id, prodname, price, quantity, user_id, picture_location)VALUES(default,'$prodname','$price','1','$userid', '$picture')";
        }
    
    if (mysqli_query($conn, $sql)){
        ?>
        <script>
            alert('Successfully added.');
            window.location.href='product_user.php?username=<?php echo $user ?>';
        </script>
      <?php 
    } 
    else{
        ?>
        <script>
            alert('Invalid.');
            window.location.href='product_user.php?username=<?php echo $user ?>';
        </script>
      <?php 
    }

	mysqli_close ($conn);

?>

       
