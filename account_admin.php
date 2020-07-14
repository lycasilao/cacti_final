<!--
#--------------------------------------------------------------------------#
# Filename        :  account_admin.php                                     #
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
                        <a class="navbar-brand" href="dashboard_admin.php?username=<?php echo $user?>"><img src="images/logo.png" class="logo" alt=""></a>
                    </div>
                    <!-- End Header Navigation -->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                            <li class="nav-item "><a class="nav-link" href="dashboard_admin.php?username=<?php echo $user?>">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="product_admin.php?username=<?php echo $user?>">Products</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact-us_admin.php?username=<?php echo $user?>">Contact Us</a></li>
                            <li class="nav-item active"><a class="nav-link" href="account_admin.php?username=<?php echo $user?>">Account</a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
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
                            <li class="breadcrumb-item"><a href="product_admin.php?username=<?php echo $user?>">Shop</a></li>
                            <li class="breadcrumb-item active">Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End All Title Box -->
        <?php
            $sql1 = "SELECT DISTINCT user_id FROM users "; 
            $result1 = mysqli_query($conn,$sql1);
            while($row1 = mysqli_fetch_array($result1)){
            $id =  $row1['user_id'];

            $sql2 = "SELECT username FROM users where user_id='$id'"; 
            $result2= mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_array($result2); 
            $username =  $row2['username'];

            $sql3 = "SELECT checkout_id, dates, order_status, total FROM checkout where user_id=$id"; 
            $result3 = mysqli_query($conn,$sql3);
            while($row3 = mysqli_fetch_array($result3)){
                $checkout = $row3['checkout_id'];
                $dates = $row3['dates'];
                $orderstatus = $row3['order_status'];
                $total = $row3['total'];

        ?>

        <!-- Start Cart  -->
        <div class="cart-box-main">
            <div class="container">
                    <div class="col-md-12 col-lg-9 mb-3">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="odr-box">
                                    <div class="title-left">
                                    </div>
                                    <div class="d-flex gr-total">
                                        <h5>Username</h5>
                                        <div class="ml-auto h5"> <?php echo $username?> </div>
                                    </div>
                                    <div class="rounded p-2 bg-light">
                                    <?php
                                        $query = "SELECT prodname, price, quantity FROM cart_temp where user_id ='$id' and dates = '$dates'"; 
                                        $result = mysqli_query($conn,$query);
                                        while($row = mysqli_fetch_array($result)){
                                    ?>
                                        <div class="media mb-2 border-bottom">
                                            <div class="media-body"> <a href="#"><?php echo $row['prodname'] ?></a>
                                            <div class="small text-muted">Price: Php <?php echo $row['price'] ?> <span class="mx-2">|</span> Qty: <?php echo $row['quantity'] ?> </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="d-flex gr-total">
                                            <h5>Grand Total</h5>
                                            <div class="ml-auto h5"> Php <?php echo $total?>.00 </div>
                                        </div>
                                    <form class="form-horizontal" action="orderstatus.php?username=<?php echo $username?>&id=<?php echo $checkout?>&dates=<?php echo $dates?>"" name="form" method="post">
                                    <div class="d-flex">
                                        <div class="font-weight-bold">Order Status: </div>
                                        <div class="ml-auto font-weight-bold">
                                            <select name="orderstatus" class="form-control" placeholder="" required>
                                            <option ><?php echo $orderstatus; ?></option>   
                                            <option value="Pending" >Pending</option>
                                            <option value="To Ship">To Ship</option>
                                            <option value="To Receive">To Receive</option>
                                            <option value="Completed">Completed</option>
                                           
                                            </select>
                                        </div>    
                                    </div>

                                    <div class="form-group">
                                    <label class="col-sm-4 control-label"></label>
                                    <div class="col-sm-8">
                                        <input type="submit" name="updatestatus" class="btn btn-warning" value="Update">
                                    </div>
                                </div>
                            </form>          
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php } ?> 
    <?php } ?> 
    <!-- End Cart -->    

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