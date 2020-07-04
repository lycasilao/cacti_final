<!--
#--------------------------------------------------------------------------#
# Filename        :  orderstatus.php                                       #
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
         if ((isset($_POST['updatestatus'])!="")) {
            $orderstatus = $_POST['orderstatus'];
         }
        $user = $_GET['username'];
        $id = $_GET['id'];
        $dates = $_GET['dates'];
    
        $query = "UPDATE checkout SET order_status = '$orderstatus', dates='$dates' where checkout_id = '$id'";  
                    
    if (mysqli_query($conn, $query) ){
        ?>
        <script>
            alert('Order Status Updated.');
            window.location.href='account_admin.php?username=admin';
        </script>
      <?php 
    } 
    else{
        ?>
        <script>
            alert('Invalid.');
            window.location.href='account_admin.php?username=admin';
        </script>
      <?php 
    }
    
	mysqli_close ($conn);

?>

  