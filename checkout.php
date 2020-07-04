<!--
#--------------------------------------------------------------------------#
# Filename        :  checkout.php                                          #
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

        $user = $_GET['username'];

        $sql = "SELECT user_id  FROM users WHERE username= '$user'";
        $result = mysqli_query($conn, $sql);
        $n = mysqli_fetch_array($result);
            $userid = $n['user_id'];

        $sql1 = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'cacti_database' AND TABLE_NAME = 'checkout'";
        $result1 = mysqli_query($conn, $sql1);
        $n1 = mysqli_fetch_array($result1);
            $checkoutid = $n1['AUTO_INCREMENT'];   

        $sql2 = "SELECT prodname, quantity, price  FROM cart WHERE user_id= $userid";
        $result2 = mysqli_query($conn, $sql2);
        $total = 0;


        while($n2 = mysqli_fetch_array($result2)){
            $prodname = $n2['prodname'];     
            $quantity = $n2['quantity'];  
            $price = $n2['price'];   
               
            $total = $total + $price;

            $query = "INSERT into cart_temp(cart_id, prodname, price, quantity, user_id, dates, checkout_id )VALUES(default,'$prodname','$price','$quantity','$userid', now(), '$checkoutid')";
            mysqli_query($conn, $query);
        } 
    
        $query = "INSERT into checkout(checkout_id, user_id, total, order_status, dates)VALUES(default,'$userid', '$total', 'Pending', now())";
        mysqli_query($conn, $query);

        $query = "Delete FROM cart where user_id = '$userid'";        
                    
    if (mysqli_query($conn, $query) ){
        ?>
        <script>
            alert('Successfully Checkout.');
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

  