<!--
#--------------------------------------------------------------------------#
# Filename        :  account_user.php                                      #
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

<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Site Metas -->
        <title>CACTI</title>

        <!-- Site Icons -->
        <link rel="shortcut icon" href="https://w7.pngwing.com/pngs/14/349/png-transparent-green-cactus-in-brown-pot-art-cross-stitch-embroidery-backstitch-pattern-cactus-food-etsy-cactus.png" type="image/x-icon">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Site CSS -->
        <link rel="stylesheet" href="css/style.css">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="css/responsive.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="css/custom.css">

    </head>

    <?php  $user = $_GET['username'];?>
        
    <body>
        <!-- Start Main Top -->
        <div class="main-top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- End Main Top -->

        <!-- Start Main Top -->
        <header class="main-header">
            <!-- Start Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
                <div class="container">
                    <!-- Start Header Navigation -->
                    <div class="navbar-header">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                        <a class="navbar-brand" href="dashboard_user.php?username=<?php echo $user?>"><img src="images/logo.png" class="logo" alt=""></a>
                    </div>
                    <!-- End Header Navigation -->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                            <li class="nav-item "><a class="nav-link" href="dashboard_user.php?username=<?php echo $user?>">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="product_user.php?username=<?php echo $user?>">Products</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact-us_user.php?username=<?php echo $user?>">Contact Us</a></li>
                            <li class="nav-item active"><a class="nav-link" href="account_user.php?username=<?php echo $user?>">Account</a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->

                     <!-- Start Atribute Navigation -->
                     <div class="attr-nav">
                        <ul>
                            <li class="side-menu"><a href="#">
                            <i class="fa fa-shopping-bag"></i>
                            <p>My Cart</p>
                        </ul>
                    </div>
                    <!-- End Atribute Navigation -->
                </div>
                        <?php
                            $sql = "SELECT user_id FROM users where username='$user'"; 
                            $result = mysqli_query($conn,$sql);
                            $row = mysqli_fetch_array($result); 
                            $id =  $row['user_id'];
                            $query = "SELECT prodname, price, quantity, picture_location FROM cart where user_id ='$id'"; 
                            $result = mysqli_query($conn,$query);    
                        ?>

                <!-- Start Side Menu -->
                <div class="side">
                    <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                    <li class="cart-box">         
                        <ul class="cart-list">
                            <?php
                                while($row = mysqli_fetch_array($result)){
                            ?>
                            <li>
                                <a href="#" class="photo"><img src="<?php echo $row['picture_location'] ?>" class="cart-thumb" alt="" /></a>
                                <h6><a href="#"><?php echo $row['prodname'] ?> </a></h6>
                                <p><?php echo $row['quantity'] ?> - <span class="price">Php <?php echo $row['price'] ?></span></p>
                            </li>
                            <?php
                                }
                            ?> 
                        <br>
                        <button class="btn btn-warning" ><a  class="nav" href="checkout.php?username=<?php echo $user?>">Checkout</a></button> <br> <br>
                        </ul> 
                    </li>
                </div>
                <!-- End Side Menu -->
            </nav>
            <!-- End Navigation -->
        </header>
        <!-- End Main Top -->

        <!-- Start Top Search -->
        <div class="top-search">
            <div class="container">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                </div>
            </div>
        </div>
        <!-- End Top Search -->

        <!-- Start Top Search -->
        <div class="top-search">
            <div class="container">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                </div>
            </div>
        </div>
        <!-- End Top Search -->

        <!-- Start All Title Box -->
        <div class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>ORDERS</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="product_user.php?username=<?php echo $user?>">Shop</a></li>
                            <li class="breadcrumb-item active">Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End All Title Box -->
          
        <?php
            $sql3 = "SELECT user_id FROM users where username='$user'"; 
            $result3 = mysqli_query($conn,$sql3);
            $row3 = mysqli_fetch_array($result3); 
            $id =  $row3['user_id'];
                                
            $sql1 = "SELECT checkout_id FROM checkout where user_id=$id"; 
            $result1 = mysqli_query($conn,$sql1);
            while($row1 = mysqli_fetch_array($result1)){
                $check = $row1['checkout_id'];
        ?>

        <!-- Start Cart  -->
        <div class="cart-box-main">
            <div class="container">
                    <div class="col-sm-6 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="odr-box">
                                    <div class="title-left">
                                    </div>
                                    <div class="rounded p-2 bg-light">
                                    <?php
                                        $sql2 = "SELECT dates, order_status, total FROM checkout where checkout_id=$check"; 
                                        $result2 = mysqli_query($conn,$sql2);
                                        $row2 = mysqli_fetch_array($result2);
                                            $dates = $row2['dates'];
                                            $orderstatus = $row2['order_status'];
                                            $total = $row2['total'];

                                        $query4 = "SELECT prodname, price, quantity FROM cart_temp where user_id =$id and checkout_id='$check'"; 
                                        $result4 = mysqli_query($conn,$query4);
                                        while($row4 = mysqli_fetch_array($result4)){
                                        
                                    ?>
                                        <div class="media mb-2 border-bottom">
                                            <div class="media-body"> <a href="#"><?php echo $row4['prodname'] ?></a>
                                                <div class="small text-muted">Price: Php <?php echo $row4['price'] ?> <span class="mx-2">|</span> Qty: <?php echo $row4['quantity'] ?> </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="d-flex gr-total">
                                            <h5>Grand Total</h5>
                                            <div class="ml-auto h5"> Php <?php echo $total?>.00 </div>
                                        </div>
                                        <div class="col-md-12 col-lg-12">
                                            <div class="order-box">
                                                <div class="d-flex">
                                                    <div class="font-weight-bold"><div class="font-weight-bold">Order Status: <?php echo $orderstatus?></div></div>  
                                                </div>  
                                                <div>
                                                <button class="btn btn-warning" ><a  class="nav" href="/cacti/stripe/index.php">Pay Now</a></button> <br> <br>
                                                <form class="paypal" action="payment.php" method="post" id="paypal_form">
                                                    <input type="hidden" name="cmd" value="_xclick" />
                                                    <input type="hidden" name="no_note" value="1" />
                                                    <input type="hidden" name="lc" value="UK" />
                                                    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
                                                    <input type="hidden" name="first_name" value="Customer's First Name" />
                                                    <input type="hidden" name="last_name" value="Customer's Last Name" />
                                                    <input type="hidden" name="payer_email" value="customer@example.com" />
                                                    <input type="hidden" name="item_number" value="123456" />
                                                    <table border="0" cellpadding="10" cellspacing="0" align="right"><tr><td align="right"></td></tr><tr><td align="right"><input type="image" src="https://www.paypalobjects.com/webstatic/en_AU/i/buttons/btn_paywith_primary_s.png" alt="Submit" /></td></tr></table>
                                                </form>
                                               
                                                <!-- PayPal Logo -->
                                                
                                                <!-- PayPal Logo -->
                                                </div>
                                               
                                                </div>
                                            </div>
                                        </div>
                               
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
        <!-- End Cart -->
        <?php } ?>                      

         <!-- this modal is for Add Product -->
            <div class="modal fade" id="checkout" role="dialog">
                <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:20px 50px;">
                        <h3 align="center" ><b>Place Order</b></h3>
                    <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
        
                    <form class="form-horizontal" action="#" name="form" method="post">
                    <div class="paypal">
                        <button type="submit" name="paypal"><img src="https://www.paypalobjects.com/webstatic/mktg/Logo/pp-logo-100px.png" border="0" alt="PayPal Logo"></button>
                    </div>
                    </form>
        
                    </div>
                </div>
                </div>
            </div>
        <!-- Start copyright  -->
        <div class="footer-copyright">
            <p class="footer-company">All Rights Reserved. &copy; 2020 <a href="#">CACTI&CO</a></p>
        </div>
        <!-- End copyright  -->

        <!-- ALL JS FILES -->
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- ALL PLUGINS -->
        <script src="js/jquery.superslides.min.js"></script>
        <script src="js/bootstrap-select.js"></script>
        <script src="js/inewsticker.js"></script>
        <script src="js/bootsnav.js."></script>
        <script src="js/images-loded.min.js"></script>
        <script src="js/isotope.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/baguetteBox.min.js"></script>
        <script src="js/form-validator.min.js"></script>
        <script src="js/contact-form-script.js"></script>
        <script src="js/custom.js"></script>
    </body>

</html>