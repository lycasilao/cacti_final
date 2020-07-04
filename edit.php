<!--
#--------------------------------------------------------------------------#
# Filename        :  edit.php                                              #
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

<?php  include('update_product.php'); ?>
<?php 
	if (isset($_GET['edit'])) {
		$code = $_GET['edit'];
		$update = true;
        $sql = "SELECT * FROM products WHERE product_code= $code";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
          printf("Error: %s\n", mysqli_error($conn));
          exit();
        }
        
        $n = mysqli_fetch_array($result);
        $id = $n['product_code'];
		    $prodname = $n['prodname'];
        $prodtype= $n['prodtype'];
        $price = $n['price'];
        $stocks = $n['stocks'];
        $picture = $n['picture_location'];
    }
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
  <body>
      <!-- this modal is for Edit Product -->
              <div class="modal-dialog">
              
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header" style="padding:20px 50px;">
                    <h3 align="center" ><b>Edit Product</b></h3>
                    <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                  </div>
                  <div class="modal-body" style="padding:40px 50px;">
      
                    <form class="form-horizontal" action="#" name="form" method="post">
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Product Name</label>
                            <div class="col-sm-8">
                              <input type="text" name="prodname" class="form-control" placeholder="" value="<?php echo $prodname; ?>" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Category</label>
                          <div class="col-sm-8">
                              <select name="prodtype" class="form-control" placeholder="" required>
                              <option value="<?php echo $prodname; ?>"><?php echo $prodtype; ?></option>
                              <option value="cactus">Cactus</option>
                              <option value="succulent">Succulent</option>
                              <option value="sets">Sets</option>
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Price</label>
                            <div class="col-sm-8">
                              <input type="text" name="price" class="form-control" placeholder="" value="<?php echo $price; ?>" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Stocks</label>
                            <div class="col-sm-8">
                              <input type="text" name="stocks" class="form-control" placeholder="" value="<?php echo $stocks; ?>" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Picture Location</label>
                            <div class="col-sm-8">
                              <input type="text" name="picture" class="form-control" placeholder=""  value="<?php echo $picture; ?>" required="required">
                            </div>
                        </div>        
                        <div class="input-group">
                            <?php if ($update == true): ?>
                            <button class="btn btn-success" type="submit" name="update" style="background: #556B2F;" >update</button>
                        <?php else: ?>
                            <button class="btn btn-success" type="submit" name="register" >Save</button>
                        <?php endif ?>
                            </div>
                      </form>
                  </div>
                </div>
              </div>
  </body>

</html>