<!--
#--------------------------------------------------------------------------#
# Filename        :  send-message.php                                      #
# Author          :  Lyka C. Casilao                                       #        
# Last Modified   :  July 13, 2020                                         #
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
    $user = $_GET['username'];
   
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
    
?>

<?php

    require_once "vendor/autoload.php"; 
    use Twilio\Rest\Client;

    $account_sid = "ACd90c3ac0576ea0160d4083f5ed092b85";
    $auth_token = "4e1085ce0c11a670b524329ad364278e";
    $twilio_phone_number = " +12055093615";

    $client = new Client($account_sid, $auth_token);

    $client->messages->create(
        '+639267456744',
        [
            "from" => $twilio_phone_number,
            "body" => "Name: $name Email: $email Subject: $subject Message: $message "
        ]
    );
?>
<script>
    alert('Text message sent.');
    window.location.href='contact-us_user.php?username=<?php echo $user ?>';
</script>
