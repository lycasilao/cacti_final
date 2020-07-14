<!--
#--------------------------------------------------------------------------#
# Filename        :  dbConnect.php                                         #
# Author          :  Lyka C. Casilao                                       #        
# Last Modified   :  July 11, 2020                                         #
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
    // Connect with the database 
    $db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME); 

    // Display error if failed to connect 
    if ($db->connect_errno) { 
        printf("Connect failed: %s\n", $db->connect_error); 

    exit(); 

 }