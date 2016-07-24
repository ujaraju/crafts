<?php
  session_start();
  ob_start();
  $sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";
?>

<?php include_once($sitePath."/inc/_header.php"); ?>
<?php include_once($sitePath."/user/nav.php"); ?>
<?php include_once($sitePath."/inc/_dbconnect.php"); ?>


<?php
//check if itemid is set or exist in the database
if(isset($_GET['itemId'])) {
	$prodid = $_GET['itemId'];
	//$prodid = preg_replace('#[^0-9]#i', , $_GET['itemid']);
	

 		$query = "SELECT * FROM products where product_id='$prodid' LIMIT 1";
      	$result = mysqli_query($con, $query);
       	$itemcount = mysqli_num_rows($result);
       
     if ($itemcount>0) {
      while ($row = mysqli_fetch_array($result)) {

          $itemId = $row["product_id"];
          $itemName= $row["product_name"];
          $itemDesc= $row["product_description"];
          $itemPrice= $row["price"];
          $itemCategoryID= $row["category_id"];
          $itemImage = $host.'media/products/medium/'.$itemId.'.jpg';
          $itemImageLarge = $host.'media/products/'.$itemId.'.jpg';

     }	
   }
 } else {
?>
<div class="alert alert-danger">No Products to display</div>
<?php
	exit();
    mysql_close();
}
?>



	<div id="" class="row m-y-md">
		<div class="col-sm-6 col-md-5">



	        <div id="<?php echo $itemId; ?>" class="product">
          <figure>
            <a id="zoom" class="cloud-zoom" href="<?php echo  $itemImageLarge; ?>" rel="position:'inside',showTitle:false,adjustX:0,adjustY:0">
                <img class="img-responsive" src="<?php echo  $itemImage; ?>"/>
            </a>
          </figure>
	        </div>
            
		
		</div>


		<div class="col-sm-6 col-md-6 col-md-offset-1">

          <h2><?php echo $itemName; ?></h2>
          <hr>

          <p><?php echo $itemDesc; ?></p>
          <hr>
        
          <ul class="list-inline">
            <li>Share this on</li>
            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
          </ul>

          <hr>

          <div class="add-to-cart pull-left">
            <div class="input-group">  
              <span class="input-group-addon">
                $<?php echo $itemPrice; ?>
              </span>
              <span class="input-group-btn action">
                <a class="btn btn-primary"  href="<?php echo 'cart.php?itemId='.$itemId; ?> ">
                add to cart
                </a>
              </span>
            </div>
          </div>

		</div>
	
	</div>

<?php include_once($sitePath."/inc/_footer.php"); ?>
