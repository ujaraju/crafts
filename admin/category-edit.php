<?php
session_start();
ob_start();

if (!isset($_SESSION["manager"])) {
	header("location:login.php");
	exit();
	}
  $sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";
  $mediaCategories = $sitePath."/media/categories/"; 
  $thumbMediaCategories = $sitePath.'/media/categories/thumb/'; 
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
	$sql= "SELECT * FROM categories where category_id = '$iid' LIMIT 1";
	$result = mysqli_query($con, $sql);
	if (mysqli_num_rows($result) == 1) {

		$row = mysqli_fetch_array($result);
        $itemId = $row["category_id"];
        $itemName= $row["category_name"];
        $itemDesc= $row["category_description"];
		} else {
		echo ('No categories to display');
  		}
	
	}
?>


<form class="form-horizontal" action="category-edit.php" enctype="multipart/form-data" method="post">

	<div class="modal-body">
			<div class="form-group">
	            <label class="col-sm-4">Category Name</label>
				<div class="col-sm-8">
					<input class="form-control" name="itemName" type="text" value="<?php echo $itemName; ?>" id="itemName" size="30" />
				</div>
			</div>

			<div class="form-group">
	            <label class="col-sm-4">Category Description</label>
				<div class="col-sm-8">
					<textarea class="form-control" name="ItemDesc" type="text" id="ItemDesc" ><?php echo $itemDesc; ?></textarea>
				</div>
			</div>

	        <div class="form-group">
	            <label class="col-sm-4">Product Image</label>
	            <div class="col-sm-8">
	              <input name="fileField" type="file" id="fileField" />
	            </div>
	        </div>

	</div>

	<div class="modal-footer text-right">
		<input type="hidden" name="thisID" value="<?php echo $iid; ?>" />
		<input class="btn btn-success" type="submit" value="Update Category" />	
	</div>
</form>

<?php  
if (isset($_POST['itemName'])) {
	
	$itemid = trim($_POST['thisID']);
	$title = trim($_POST['itemName']);
	$desc = trim($_POST['ItemDesc']);
	
	//Update this menu item in the Menu table
	$sql = "UPDATE categories SET category_name='$title', category_description='$desc' WHERE category_id='$itemid'";
	$result = mysqli_query($con, $sql);
	$pid = mysqli_insert_id($con);
	
		//Place image in the folder
		$newname = "$pid.jpg";
		//move_uploaded_file( $_FILES['fileField']['tmp_name'], $mediaCategories."$newname");
						
						//create small medium adn thumbnail image of the uploaded image
					   if(move_uploaded_file( $_FILES['fileField']['tmp_name'], $mediaCategories."$newname")) {
							 
							 if(copy($mediaCategories.$newname, $thumbMediaCategories.$newname)) {
								list($width, $height) = getimagesize($mediaCategories.$newname);
								$width_thumb = 90;
								$ratio = ($width_thumb / $width) * 100;
								$height_thumb = ($ratio * $height) / 100;		 
								$thumb = imagecreatetruecolor($width_thumb, $height_thumb);
								$source = imagecreatefromjpeg($thumbMediaCategories.$newname);
								
								if(imagecopyresampled($thumb, $source, 0, 0, 0, 0, $width_thumb, $height_thumb, $width, $height)) {
									imagejpeg($thumb, $thumbMediaCategories.$newname, 100);
							 		echo 'Thumbnail successfully resized'; 
								} else { 
									echo 'Thumbnail resize process hit a wall!';
								}
							}
							else {
								echo 'Thumbnail could not be created!';
							}
						}


		header("location:category.php");
		exit();
	}

?>

<?php //include_once($sitePath."/inc/_footer.php"); ?>
