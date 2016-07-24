<?php
session_start();
ob_start();

if (!isset($_SESSION["manager"])) {
	header("location:login.php");
	exit();
	}
  $sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";
  $mediaProducts = $sitePath."/media/products/"; 
?>


<?php //include_once($sitePath."/inc/_header.php"); ?>
<?php //include_once($sitePath."/admin/nav.php"); ?>
<?php include_once($sitePath."/inc/_dbconnect.php"); ?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">Edit Product</h4>
</div>

<?php
//Display chosen menu item
if(isset($_GET['itemid'])) {
	$iid = $_GET['itemid'];

	//echo "<h1>".$iid."</h1>";	
	$sql= "SELECT c.* , p.* FROM categories c,products p WHERE c.category_id=p.category_id AND product_id = '$iid' LIMIT 1";
	//$sql= "SELECT * FROM products where product_id = '$iid' LIMIT 1";
	$result = mysqli_query($con, $sql);
	if (mysqli_num_rows($result) == 1) {

		$row = mysqli_fetch_array($result);
        $itemId = $row["product_id"];
        $itemName= $row["product_name"];
        $itemDesc= $row["product_description"];
        $itemPrice= $row["price"];
        $itemCategoryID= $row["category_id"];
        $itemCategoryName= $row["category_name"];
		} else {
		echo ('No products to display');
  		}
	
	}
?>


<!-- get category options-->
<?php
$sql1= "SELECT * FROM categories";
$result1 = mysqli_query($con, $sql1);
$itemcount1 = mysqli_num_rows($result1);
$categoryoptions = "";

if ($itemcount1>0) {

  while ($row1 = mysqli_fetch_array($result1)) {
      $categoryID= $row1["category_id"];
      $categoryName = $row1["category_name"];

		$categoryoptions.= "<option value='".$categoryID."'>".$categoryName."</option>";
 	}
 }
?>



<form class="form-horizontal" action="inventory-edit.php" enctype="multipart/form-data" method="post">
	          
	<div class="modal-body">
			<div class="form-group">
	            <label class="col-sm-4">Product Name</label>
	            <div class="col-sm-8">
	                <input class="form-control" name="itemName" type="text" value="<?php echo $itemName; ?>" id="itemName" size="30" />
	            </div>
	        </div>
	        <div class="form-group">
	            <label class="col-sm-4">Menu Item Description</label>
	            <div class="col-sm-8">
	                <textarea class="form-control" name="ItemDesc" type="text" id="ItemDesc" ><?php echo $itemDesc; ?></textarea>
	            </div>
	        </div>
	        
	        <div class="form-group">
	            <label class="col-sm-4">Price</label>
	            <div class="col-sm-8">
					<div class="input-group">
						<span class="input-group-addon">$</span>
						<input class="form-control" name="itemPrice" type="text" value="<?php echo $itemPrice; ?>" id="itemPrice" size="12" />
					</div>
	            </div>
	        </div>
	        
	        <div class="form-group">
	            <label class="col-sm-4">Product Category</label>
	            <div class="col-sm-8">
					<select class="form-control" name="itemCategory">
						<option value="<?php echo $itemCategoryID; ?>"><?php echo $itemCategoryName; ?></option>
	              		<?php echo $categoryoptions; ?>
	              	</select>
	            </div>
	        </div>

	        <div class="form-group">
	            <label class="col-sm-4">Product Image</label>
	            <div class="col-sm-8">
	              <input class="" name="fileField" type="file" id="fileField" />
	            </div>
	        </div>


	</div><!-- modal-body -->

	<div class="modal-footer text-right">
		<input type="hidden" name="thisID" value="<?php echo $iid; ?>" />
		<input class="btn btn-success" type="submit" value="Update Product" />	
	</div>

</form>



<?php  
if (isset($_POST['itemName'])) {
	
	$itemid = trim($_POST['thisID']);
	$title = trim($_POST['itemName']);
	$desc = trim($_POST['ItemDesc']);
	$price = trim($_POST['itemPrice']);
	$cat = trim($_POST['itemCategory']);
	
	//Update this menu item in the Menu table
	$sql = "UPDATE products SET product_name='$title', product_description='$desc', price='$price', category_id='$cat' WHERE product_id='$itemid'";
	$result = mysqli_query($con, $sql);
	$pid = mysqli_insert_id($con);
	//Place image in the folder
	$newname = "$pid.jpg";
	move_uploaded_file( $_FILES['fileField']['tmp_name'], $mediaProducts."$newname");

	header("location: inventory.php");
	exit();
	}

?>

<?php //include_once($sitePath."/inc/_footer.php"); ?>
