<!--
#--------------------------------------------------------------------------#
# Filename        :  db.php                                                #
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
    $servername = "localhost";
    $username = "lykacasilao";
    $password = "admin";
    $db = 'cacti_database';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db) or die("Unable to connect");
?>

