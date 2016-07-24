  <?php// Configuration - Your Options
      $allowed_filetypes = array('.jpg','.gif','.bmp','.png'); 
      $max_filesize = 524288; 
      $upload_path = 'user_files/uploaded/images/uploaded/'; 
      $upload_thumb_path = $upload_path.'thumbs/'; 
 
   $filename = $_FILES['userfile']['name']; 
   $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
 
   if(!in_array($ext,$allowed_filetypes))
      die('The file you attempted to upload is not allowed.');
 
   if(filesize($_FILES['userfile']['tmp_name']) > $max_filesize)
      die('The file you attempted to upload is too large.');
 
   if(!is_writable($upload_path))
      die('You cannot upload to the specified directory, please CHMOD it to 777.');
 
   if(move_uploaded_file($_FILES['userfile']['tmp_name'],$upload_path . $filename)) {
         echo 'Your file upload was successful, view the file <a href="' . $upload_path . $filename . '" title="Your File">here</a>'; // It worked.
		 if(copy($upload_path.$filename, $upload_thumb_path.$filename)) {
			echo 'Thumbnail file created successfully'.$filename;
			list($width, $height) = getimagesize($upload_path.$filename);
			$width_thumb = 100;
			$ratio = ($width_thumb / $width) * 100;
			$height_thumb = ($ratio * $height) / 100;		 
			$thumb = imagecreatetruecolor($width_thumb, $height_thumb);
			$source = imagecreatefromjpeg($upload_thumb_path.$filename);
			if(imagecopyresampled($thumb, $source, 0, 0, 0, 0, $width_thumb, $height_thumb, $width, $height)) {
				imagejpeg($thumb, $upload_thumb_path.$filename, 100);
		 		echo 'Thumbnail successfully resized'; 
			} else { 
				echo 'Thumbnail resize process hit a wall!';
			}
		}
		else {
			echo 'Thumbnail hit a wall!';
		}
	}
    else
    	echo 'There was an error during the file upload.  Please try again.';