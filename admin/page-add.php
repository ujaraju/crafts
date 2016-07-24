<?php
session_start();
ob_start();

if (!isset($_SESSION["manager"])) {
	header("location:login.php");
	exit();
	}
  $sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";
  $mediaProducts = $sitePath."/media/products/"; 
  $thumbMediaProducts = $sitePath.'/media/products/thumb/'; 
  $smallMediaProducts = $sitePath.'/media/products/small/'; 
  $mediumMediaProducts = $sitePath.'/media/products/medium/'; 
?>


<?php //include_once($sitePath."/inc/_header.php"); ?>
<?php //include_once($sitePath."/admin/nav.php"); ?>
<?php include_once($sitePath."/inc/_dbconnect.php"); ?>




            <?php  
            
            if (isset($_POST['product_name'])) {
              
				$title = trim($_POST['product_name']);
				$desc = trim($_POST['description']);
				$price = trim($_POST['price']);
				$cat = trim($_POST['category']);
				//check if this title doesn't exist
				$sql= "SELECT product_id FROM products where product_name='$title' LIMIT 1";
				$result = mysqli_query($con, $sql);
				$itemcount = mysqli_num_rows($result);
				if ($itemcount>0) {
				  echo ('Sorry this item already exist. <a href="inventory.php">Click Here to continue</a>');
				  exit();
				}
				
				
				//Add this menu item to the Menu table
				$sql="INSERT INTO products (product_name, product_description, price, category_id) VALUES ('$title', '$desc', '$price', '$cat')"; 
				
				mysqli_query($con, $sql);
				$pid = mysqli_insert_id($con);
				//echo($pid);

				//Place image in the folder
				$newname = "$pid.jpg";
						//create small medium adn thumbnail image of the uploaded image
					   if(move_uploaded_file( $_FILES['fileField']['tmp_name'], $mediaProducts."$newname")) {
							 
							 if(copy($mediaProducts.$newname, $thumbMediaProducts.$newname)) {
								list($width, $height) = getimagesize($mediaProducts.$newname);
								$width_thumb = 90;
								$ratio = ($width_thumb / $width) * 100;
								$height_thumb = ($ratio * $height) / 100;		 
								$thumb = imagecreatetruecolor($width_thumb, $height_thumb);
								$source = imagecreatefromjpeg($thumbMediaProducts.$newname);
								
								if(imagecopyresampled($thumb, $source, 0, 0, 0, 0, $width_thumb, $height_thumb, $width, $height)) {
									imagejpeg($thumb, $thumbMediaProducts.$newname, 100);
							 		echo 'Thumbnail successfully resized'; 
								} else { 
									echo 'Thumbnail resize process hit a wall!';
								}
							}
							else {
								echo 'Thumbnail could not be created!';
							}

							if(copy($mediaProducts.$newname, $smallMediaProducts.$newname)) {
								list($width, $height) = getimagesize($mediaProducts.$newname);
								$width_thumb = 400;
								$ratio = ($width_thumb / $width) * 100;
								$height_thumb = ($ratio * $height) / 100;		 
								$thumb = imagecreatetruecolor($width_thumb, $height_thumb);
								$source = imagecreatefromjpeg($smallMediaProducts.$newname);

								if(imagecopyresampled($thumb, $source, 0, 0, 0, 0, $width_thumb, $height_thumb, $width, $height)) {
									imagejpeg($thumb, $smallMediaProducts.$newname, 100);
							 		echo 'Thumbnail successfully resized'; 
								} else { 
									echo 'Thumbnail resize process hit a wall!';
								}
							}
							else {
								echo 'Small Imagecould not be created!';
							}


							if(copy($mediaProducts.$newname, $mediumMediaProducts.$newname)) {
								list($width, $height) = getimagesize($mediaProducts.$newname);
								$width_thumb = 800;
								$ratio = ($width_thumb / $width) * 100;
								$height_thumb = ($ratio * $height) / 100;		 
								$thumb = imagecreatetruecolor($width_thumb, $height_thumb);
								$source = imagecreatefromjpeg($mediumMediaProducts.$newname);

								if(imagecopyresampled($thumb, $source, 0, 0, 0, 0, $width_thumb, $height_thumb, $width, $height)) {
									imagejpeg($thumb, $mediumMediaProducts.$newname, 100);
							 		echo 'Thumbnail successfully resized'; 
								} else { 
									echo 'Thumbnail resize process hit a wall!';
								}
							}
							else {
								echo 'Small Imagecould not be created!';
							}


						}

				header("location:inventory.php");
				exit();
              }
            ?>








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



      
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title">Add new product</h4>
</div>


<form class="form-horizontal" action="inventory-add.php" enctype="multipart/form-data" method="post">
	<div class="modal-body">
	          
	<div class="modal-body">
			<div class="form-group">
	            <label class="col-sm-4">Product Name</label>
	            <div class="col-sm-8">
	                <input class="form-control" name="product_name" type="text" id="product_name" size="30" />
	            </div>
	        </div>
	        <div class="form-group">
	            <label class="col-sm-4">Menu Item Description</label>
	            <div class="col-sm-8">
	                <textarea class="form-control" name="description" type="text" id="description"></textarea>
	            </div>
	        </div>
	        
	        <div class="form-group">
	            <label class="col-sm-4">Price</label>
	            <div class="col-sm-8">
	              <div class="input-group">
	                <span class="input-group-addon">
	                  $
	                </span>
	                <input class="form-control" name="price" type="text" id="price" size="12" />
	              </div>
	            </div>
	        </div>
	        
	        <div class="form-group">
	            <label class="col-sm-4">Product Category</label>
	            <div class="col-sm-8">
	              <select class="form-control" name="category">
	              		<?php echo $categoryoptions; ?>
	              </select>
	            </div>
	        </div>

	        <div class="form-group">
	            <label class="col-sm-4">Product Image</label>
	            <div class="col-sm-8">
	              <input name="fileField" type="file" id="fileField" />
	            </div>
	        </div>


	</div><!-- modal-body -->

	<div class="modal-footer text-right">
	  <input class="btn btn-success" type="submit" value="Add Product" />
	</div>

</form>



<?php //include_once($sitePath."/inc/_footer.php"); ?>
