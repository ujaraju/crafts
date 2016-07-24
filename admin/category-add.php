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



            <?php  
            
            if (isset($_POST['name'])) {
              
				$title = trim($_POST['name']);
				$desc = trim($_POST['description']);
				//check if this title doesn't exist
				$sql= "SELECT category_id FROM categories where category_name='$title' LIMIT 1";
				$result = mysqli_query($con, $sql);
				$itemcount = mysqli_num_rows($result);
				if ($itemcount>0) {
				  echo ('Sorry this categoru already exist. <a href="category.php">Click Here to continue</a>');
				  exit();
				}
				
				
				//Add this menu item to the Menu table
				$sql="INSERT INTO categories (category_name, category_description, category_id) VALUES ('$title', '$desc','$cat')"; 
				
				mysqli_query($con, $sql);
				$pid = mysqli_insert_id($con);
				//echo($pid);

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


      
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title">Add new category</h4>
</div>


<form class="form-horizontal" action="category-add.php" enctype="multipart/form-data" method="post">
	<div class="modal-body">
			<div class="form-group">
	            <label class="col-sm-4">Category Name</label>
	            <div class="col-sm-8">
	                <input class="form-control" name="name" type="text" id="name" size="30" />
	            </div>
	        </div>

			<div class="form-group">
	            <label class="col-sm-4">Category Description</label>
	            <div class="col-sm-8">
	                <textarea class="form-control" name="description" type="text" id="description"></textarea>
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
	  <input class="btn btn-success" type="submit" value="Add Category" />
	</div>

</form>



<?php //include_once($sitePath."/inc/_footer.php"); ?>
