<!--
#--------------------------------------------------------------------------#
# Filename        :  success.php                                           #
# Author          :  Lyka C. Casilao                                       #        
# Last Modified   :  July 12, 2020                                         #
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

    // Include configuration file 

    include_once 'config.php'; 

    // Include database connection file 

    include_once 'dbConnect.php'; 

    // If transaction data is available in the URL 

    if(!empty($_GET['item_number']) && !empty($_GET['tx']) && !empty($_GET['amt']) && !empty($_GET['cc']) && !empty($_GET['st'])){ 

        // Get transaction information from URL 

        $item_number = $_GET['item_number'];  

        $txn_id = $_GET['tx']; 

        $payment_gross = $_GET['amt']; 

        $currency_code = $_GET['cc']; 

        $payment_status = $_GET['st']; 


        // Get product info from the database 

        $productResult = $db->query("SELECT * FROM products WHERE id = ".$item_number); 

        $productRow = $productResult->fetch_assoc(); 

        // Check if transaction data exists with the same TXN ID. 

        $prevPaymentResult = $db->query("SELECT * FROM payments WHERE txn_id = '".$txn_id."'"); 

        if($prevPaymentResult->num_rows > 0){ 

            $paymentRow = $prevPaymentResult->fetch_assoc(); 

            $payment_id = $paymentRow['payment_id']; 

            $payment_gross = $paymentRow['payment_gross']; 

            $payment_status = $paymentRow['payment_status']; 

    }else{ 

            // Insert transaction data into the database 

            $insert = $db->query("INSERT INTO payments(item_number,txn_id,payment_gross,currency_code,payment_status) VALUES('".$item_number."','".$txn_id."','".$payment_gross."','".$currency_code."','".$payment_status."')"); 

            $payment_id = $db->insert_id; 

    } 

    } 

?>

    <div class="container">

        <div class="status">

            <?php if(!empty($payment_id)){ ?>

                <h1 class="success">Your Payment has been Successful</h1>

                <h4>Payment Information</h4>

                <p><b>Reference Number:</b> <?php echo $payment_id; ?></p>

                <p><b>Transaction ID:</b> <?php echo $txn_id; ?></p>

                <p><b>Paid Amount:</b> <?php echo $payment_gross; ?></p>

                <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>

                <h4>Product Information</h4>

                <p><b>Name:</b> <?php echo $productRow['name']; ?></p>

                <p><b>Price:</b> <?php echo $productRow['price']; ?></p>

            <?php }else{ ?>

                <h1 class="error">Your Payment has Failed</h1>

            <?php } ?>

        </div>

        <a href="index.php" class="btn-link">Back to Products</a>

    </div>