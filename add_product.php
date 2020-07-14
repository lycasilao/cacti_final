<!--
#--------------------------------------------------------------------------#
# Filename        :  add_product.php                                       #
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
  if(isset($_POST['add'])!="")
  {
        $name = $_POST['prodname'];
        $type = $_POST['prodtype'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $location = $_POST['location'];
        
      $sql = "INSERT into products(product_code, prodname, prodtype, price, stocks, picture_location)VALUES(default,'$name','$type','$price','$stock', '$location')";
      if (mysqli_query($conn, $sql)){
          ?>
          <script>
              alert('Successfully added.');
              window.location.href='product_admin.php?username=admin';
          </script>
        <?php 
      } 
      else{
          ?>
          <script>
              alert('Invalid.');
              window.location.href='product_admin.php?username=admin';
          </script>
        <?php 
      }

  }
   mysqli_close ($conn);
?>

       
