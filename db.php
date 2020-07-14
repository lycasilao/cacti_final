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
    session_start();
    session_regenerate_id(true);
    // change the information according to your database
    $db_connection = mysqli_connect("localhost","lykacasilao","admin","cacti_database");
    // CHECK DATABASE CONNECTION
    if(mysqli_connect_errno()){
        echo "Connection Failed".mysqli_connect_error();
        exit;
}