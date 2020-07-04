<!--
#--------------------------------------------------------------------------#
# Filename        :  registration.php                                      #
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
if(isset($_POST['register'])!="")
{

      $first = $_POST['firstname'];
      $last = $_POST['lastname'];
      $user = $_POST['username'];
      $contact = $_POST['contact'];
      $gmail = $_POST['gmail'];
      $pass= $_POST['password'];

      
    $sql = "INSERT into users(user_id, firstname, lastname, username, contactno, gmail, passwords)VALUES(default,'$first','$last','$user', '$contact', '$gmail', '$pass')";
    if (mysqli_query($conn, $sql)){
        ?>
        <script>
            alert('Successfully added. You can now Login!');
            window.location.href='index.php';
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

	mysqli_close ();
}
?>

       
