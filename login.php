<!--
#--------------------------------------------------------------------------#
# Filename        :  login.php                                             #
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
    require 'db.php';

    if(isset($_SESSION['login_id'])){
        header('Location: home.php');
        exit;
    }

    require 'vendor/autoload.php';

    // Creating new google client instance
    $client = new Google_Client();

    // Enter your Client ID
    $client->setClientId('42471510406-1ul80glm993g7b6mfs7bc7sqv2bcs5o2.apps.googleusercontent.com');
    // Enter your Client Secrect
    $client->setClientSecret('6K9DVKeJ-QI13gzIXFun9sm6');
    // Enter the Redirect URL
    $client->setRedirectUri('http://localhost/cacti/login.php');

    // Adding those scopes which we want to get (email & profile Information)
    $client->addScope("email");
    $client->addScope("profile");


    if(isset($_GET['code'])):

        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

        if(!isset($token["error"])){

            $client->setAccessToken($token['access_token']);

            // getting profile information
            $google_oauth = new Google_Service_Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();
        
            // Storing data into database
            $id = mysqli_real_escape_string($db_connection, $google_account_info->id);
            $full_name = mysqli_real_escape_string($db_connection, trim($google_account_info->username));
            $email = mysqli_real_escape_string($db_connection, $google_account_info->email);
            $profile_pic = mysqli_real_escape_string($db_connection, $google_account_info->picture);

            // checking user already exists or not
            $get_user = mysqli_query($db_connection, "SELECT user_id, username FROM users WHERE user_id='$id'");
            if(mysqli_num_rows($get_user) > 0){
                $row = mysqli_fetch_array($get_user);
                $_SESSION['login_id'] = $id; 
                $username = $row['username'];
                header("Location: dashboard_user.php?username=$username");
                exit;

            }
            else{

                // if user not exists we will insert the user
                $insert = mysqli_query($db_connection, "INSERT INTO `users`(`user_id`,`username`,`email`,`profile_image`) VALUES('$id','$full_name','$email','$profile_pic')");

                if($insert){
                    $_SESSION['login_id'] = $id; 
                    header('Location: home.php');
                    exit;
                }
                else{
                    echo "Sign up failed!(Something went wrong).";
                }

            }

        }
        else{
            header('Location: login.php');
            exit;
        }
        
    else: 
        // Google Login Url = $client->createAuthUrl(); 
?>
<?php endif; ?>


