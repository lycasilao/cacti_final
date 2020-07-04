<!--
#--------------------------------------------------------------------------#
# Filename        :  login.php                                             #
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
  if(isset($_POST['login'])!=""){

      $user = $_POST['username'];
      $pass= $_POST['password'];

      $sql = "select * from users where username='$user' and passwords='$pass'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_num_rows($result);

        if ( $row > 0){
            ?>
            <script>
                alert('Successfully Login.');
                <?php
                if ($user == 'admin'){ ?>
                  window.location.href='dashboard_admin.php?username=<?php echo $user ?>';
                <?php
                }
                else{ ?>
                  window.location.href='dashboard_user.php?username=<?php echo $user ?>';
                <?php } ?>
              
            </script>
          <?php 
        } 
        else{
            ?>
            <script>
                alert('Invalid.');
                window.location.href='index.php';
            </script>
          <?php 
        }
      mysqli_close ($conn);
  }
?>
 