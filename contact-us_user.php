<!--
#--------------------------------------------------------------------------#
# Filename        :  contact-us_user.php                                   #
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
                        <a class="navbar-brand" href="dashboard_user.php"><img src="images/logo.png" class="logo" alt=""></a>
                    </div>
                    <!-- End Header Navigation -->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item "><a class="nav-link" href="dashboard_user.php?username=<?php echo $user?>">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="product_user.php?username=<?php echo $user?>">Products</a></li>
                            <li class="nav-item active" ><a class="nav-link" href="contact-us_user.php?username=<?php echo $user?>">Contact Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="account_user.php?username=<?php echo $user?>">Account</a></li>
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

        <!-- Start All Title Box -->
        <div class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Contact Us</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard_user.php?username=<?php echo $user?>">Home</a></li>
                            <li class="breadcrumb-item active"> Contact Us </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End All Title Box -->

        <!-- Start Contact Us  -->
        <div class="contact-box-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <div class="contact-form-right">
                            <h2>Message</h2>
                            <form  action="/cacti/send-message.php?username=<?php echo $user?>" name="form" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required data-error="Please enter your name">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="email" placeholder="Email" id="email" class="form-control" name="email" required data-error="Please enter your email">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required data-error="Please enter your Subject">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" id="message" placeholder="Message" name="message" rows="4" data-error="Write your message" required></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="submit-button text-center">
                                            <input class="btn btn-warning" type="submit" value="Send Message">
                                          
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="contact-info-left">
                            <h2>CONTACT INFO</h2>
                            <ul>
                                <li>
                                    <p><i class="fas fa-map-marker-alt"></i>Address: Zone 3 Timbang <br>Minalabac Camarines Sur,<br> Zip code 4414 </p>
                                </li>
                                <li>
                                    <p><i class="fas fa-phone-square"></i>Phone: <a href="#">+639267456744</a></p>
                                </li>
                                <li>
                                    <p><i class="fas fa-envelope"></i>Email: <a href="#">contactinfo@gmail.com</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Cart -->
        <div class="container" >
            <div class="row">
                <form method="post" action="">
                        <div class="col col-lg-6" align="center">
                        
                            <input id="pac-input" class="controls" type="text"
                                placeholder="Enter a location">
                            <div id="type-selector" class="controls">
                            <input type="radio" name="type" id="changetype-all" checked="checked">
                            <label for="changetype-all">All</label>
                            </div>
                            <div id="map" style="height: 400px;width: 1110px"></div>
                            <br>
                            <input type="hidden" name="lat" id="lat">
                            <input type="hidden" name="lng" id="lng">
                            <input type="hidden" name="location" id="location">
                        
                        </div>
                    </form>
                </div><!--End of row-->
            </div><!--End of conatiner-->
                <script>
                // This example requires the Places library. Include the libraries=places
                // parameter when you first load the API. For example:
                //<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXOIu59y2Cxtmjfdv7xb7G-ju6xnS4bbQ&libraries=places">

                function initMap() {
                    var map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: -33.8688, lng: 151.2195},
                    zoom: 13
                    });
                    var input = /** @type {!HTMLInputElement} */(
                        document.getElementById('pac-input'));

                    var types = document.getElementById('type-selector');
                    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                    map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

                    var autocomplete = new google.maps.places.Autocomplete(input);
                    autocomplete.bindTo('bounds', map);

                    var infowindow = new google.maps.InfoWindow();
                    var marker = new google.maps.Marker({
                    map: map,
                    anchorPoint: new google.maps.Point(0, -29)
                    });

                    autocomplete.addListener('place_changed', function() {
                    infowindow.close();
                    marker.setVisible(false);
                    var place = autocomplete.getPlace();

                    if (!place.geometry) {
                        // User entered the name of a Place that was not suggested and
                        // pressed the Enter key, or the Place Details request failed.
                        window.alert("No details available for input: '" + place.name + "'");
                        return;
                    }

                    // If the place has a geometry, then present it on a map.
                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);  // Why 17? Because it looks good.
                    }
                    marker.setIcon(/** @type {google.maps.Icon} */({
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(35, 35)
                    }));
                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);
                    var item_Lat =place.geometry.location.lat()
                    var item_Lng= place.geometry.location.lng()
                    var item_Location = place.formatted_address;
                    //alert("Lat= "+item_Lat+"_____Lang="+item_Lng+"_____Location="+item_Location);
                    $("#lat").val(item_Lat);
                    $("#lng").val(item_Lng);
                    $("#location").val(item_Location);
                    var address = '';
                    if (place.address_components) {
                        address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                        ].join(' ');
                    }

                    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                    infowindow.open(map, marker);
                    });

                    // Sets a listener on a radio button to change the filter type on Places
                    // Autocomplete.
                    function setupClickListener(id, types) {
                    var radioButton = document.getElementById(id);
                    radioButton.addEventListener('click', function() {
                        autocomplete.setTypes(types);
                    });
                    }

                    setupClickListener('changetype-all', []);
                    setupClickListener('changetype-address', ['address']);
                    setupClickListener('changetype-establishment', ['establishment']);
                    setupClickListener('changetype-geocode', ['geocode']);
                }
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places&callback=initMap"
                    async defer></script>
    

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