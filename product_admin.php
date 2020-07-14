<!--
#--------------------------------------------------------------------------#
# Filename        :  product_admin.php                                     #
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
  include("add_product.php"); 
?>
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
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
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
                            <li class="nav-item active"><a class="nav-link" href="product_admin.php?username=<?php echo $user?>">Products</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact-us_admin.php?username=<?php echo $user?>">Contact Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="account_admin.php?username=<?php echo $user?>">Account</a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
            </nav>
            <!-- End Navigation -->
        </header>
        <!-- End Main Top -->

        <!-- Start All Title Box -->
        <div class="all-title-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>PRODUCTS</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard_admin.php?username=<?php echo $user?>">Home</a></li>
                            <li class="breadcrumb-item active">Shop</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End All Title Box -->

        <!-- Start Shop Page  -->
        <div class="shop-box-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                        <div class="right-product-box">
                            <div class="product-item-filter row">
                                <div class="col-12 col-sm-8 text-center text-sm-left">
                                    <div class="toolbar-sorter-right">
                                        <span>Sort by </span>
                                        <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
                                        <option data-display="Select">Nothing</option>
                                        <option value="1">Popularity</option>
                                        <option value="2">High Price → High Price</option>
                                        <option value="3">Low Price → High Price</option>
                                        <option value="4">Best Selling</option>
                                    </select>
                                    </div>
                                </div>
                            
                            </div>
                                <?php
                                $query = "SELECT product_code, prodname, price, picture_location, stocks FROM products"; 
                                $result = mysqli_query($conn,$query);
                                ?>
                                <div class="product-categorie-box">
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                            <div class="row">
                                                <?php           
                                                while($row = mysqli_fetch_array($result)){ 
                                                    ?>
                                                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                        <div class="products-single fix">
                                                            <div class="box-img-hover">
                                                                <img src="<?php echo $row['picture_location'] ?>" class="img-fluid" alt="Image">
                                                            </div>
                                                            <div class="why-text">
                                                                <h4><?php echo $row['prodname'] ?> <br> (Stocks:<?php echo $row['stocks'] ?> ) </h4>
                                                                <h5> Php <?php echo $row['price'] ?> </h5> <br>
                                                                <a  href='edit.php?edit="<?php echo $row['product_code'] ?>"'>Edit</a>
                                                                <a href='delete.php?delete="<?php echo $row['product_code'] ?>"' onclick="return confirm('Are you sure you want to delete this product?')" >Delete</a> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                        <div class="product-categori">
                            <div class="search-product">
                                <form action="#">
                                    <button class="btn hvr-hover" type="submit">Add Product</button>
                                </form>
                            </div>
                            <div class="search-product">
                                <form action="#">
                                    <input class="form-control" placeholder="Search here..." type="text">
                                    <button type="submit"> <i class="fa fa-search"></i> </button>
                                </form>
                            </div>
                            <div class="filter-sidebar-left">
                                <button class="btn btn-warning" ><a  class="nav" data-toggle="modal" data-target="#add" href="#">Add Product</a></button> <br> <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <!-- End Shop Page -->

            <!-- this modal is for Add Product -->
            <div class="modal fade" id="add" role="dialog">
                <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:20px 50px;">
                        <h3 align="center" ><b>Add Product</b></h3>
                    <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
        
                    <form class="form-horizontal" action="#" name="form" method="post">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Product Name</label>
                            <div class="col-sm-8">
                            <input type="text" name="prodname" class="form-control" placeholder="" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-4 control-label">Category</label>
                        <div class="col-sm-8">
                            <select name="prodtype" class="form-control" placeholder="" required>
                            <option>Select</option>
                            <option value="Cactus">Cactus</option>
                            <option value="Succulent">Succulent</option>
                            <option value="Sets">Sets</option>
                            </select>
                        </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Price</label>
                            <div class="col-sm-8">
                            <input type="text" name="price" class="form-control" placeholder="" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Stocks</label>
                            <div class="col-sm-8">
                            <input type="text" name="stock" class="form-control" placeholder="" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Picture Location</label>
                            <div class="col-sm-8">
                            <input type="text" name="location" class="form-control" placeholder="" required="required">
                            </div>
                        </div>        
                        <div class="form-group">
                        <label class="col-sm-4 control-label"></label>
                        <div class="col-sm-8">
                            <input type="submit" name="add" class="btn btn-success" value="Add">
                            <input type="reset" name="" class="btn btn-danger" value="Clear">
                        </div>
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
        <script src="js/jquery-ui.js"></script>
        <script src="js/jquery.nicescroll.min.js"></script>
        <script src="js/form-validator.min.js"></script>
        <script src="js/contact-form-script.js"></script>
        <script src="js/custom.js"></script>
    </body>

</html>