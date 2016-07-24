<?php
// session_start();
// ob_start();

	// if (isset($_SESSION["manager"])) { 
	// 	header("location:adminhome.php");
	// 	exit();
	// }
	
	$sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";
	
?>

<?php include_once($sitePath."/inc/_header.php"); ?>
<?php //include_once($sitePath."/admin/nav.php"); ?>
<?php include_once($sitePath."/inc/_dbconnect.php"); ?>


	<div class="container m-y-lg">
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">		 
	    	     



<?php

			$password = trim($_POST['pwd']);
			$username = trim($_POST['user']);

			print_r($password);
			print_r($username);

			$query = "UPDATE admins SET password = '$password' WHERE username = '$username'";
			$result = mysqli_query($con, $query);
			$query1 = "SELECT username, password FROM admins WHERE username = '$username'";
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
					<a href="login.php">Click here to Log in again</a>
				</div>

				<?php			

					}
					else {
						?>
							<div class="alert alert-warning alert-top text-center">
							    <button type="button" class="close" data-dismiss="alert">&times;</button>
							    <strong>Password Reset Failed! <a href="forgotpass2.php">Try Again!</a> </strong>
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

