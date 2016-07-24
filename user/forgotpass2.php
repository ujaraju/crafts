<?php

  $sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";
  
?>

<?php include_once($sitePath."/inc/_header.php"); ?>
<?php include_once($sitePath."/user/nav.php"); ?>
<?php include_once($sitePath."/inc/_dbconnect.php"); ?>


	<div class="container m-y-lg">
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">		 
	    	     



<?php

			$password = trim($_POST['pwd']);
			$username = trim($_POST['user']);

			print_r($password);
			print_r($username);

			$query = "UPDATE users SET password = '$password' WHERE user_name = '$username'";
			$result = mysqli_query($con, $query);
			$query1 = "SELECT user_name, password FROM users WHERE user_name = '$username'";
			$result1 = mysqli_query($con, $query1);
			if (mysqli_num_rows($result1) == 1) {
				while ($row = mysqli_fetch_array($result1)) {
				$pass = $row["password"];
					if ($password == $pass){
			?>
				
				<div class="alert alert-success alert-top text-center">
				    <!-- <button type="button" class="close" data-dismiss="alert">&times;</button> -->
				    <strong>Password Reset Successful!</strong>
				    <br>
					<a href="account.php">Click here to Log in again</a>
				</div>

				<?php			

					}
					else {
						?>
							<div class="alert alert-warning alert-top text-center">
							    <button type="button" class="close" data-dismiss="alert">&times;</button>
							    <strong>Password Reset Failed! Try Again! </strong>
								<a href="forgotpass.php">Click here to reset it again</a>
							</div>
						<?php
					}
				}
			}

			
 ?>


</div>
</div>
</div>

<?php include_once("_footer.php"); ?>

