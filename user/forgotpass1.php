<?php
  
  $sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";
  
?>

<?php include_once($sitePath."/inc/_header.php"); ?>
<?php include_once($sitePath."/user/nav.php"); ?>
<?php include_once($sitePath."/inc/_dbconnect.php"); ?>


	
<div class="form-account m-y-lg">






<?php

	$username = trim($_POST['user']); 
	

	if(!empty($username) )
	{
		$query = "SELECT user_name FROM users where user_name = '$username'";
		$result = mysqli_query($con, $query);
		
			//check if the username exists
			if( mysqli_num_rows($result) == 1 )
			{

?>
					<form class="" method ="post" action = "forgotpass2.php" >
				        
				        <h2 class="form-signin-heading">Reset Password</h2>
				        <label for="password" class="sr-only">New Password</label>
				        <div class="form-group">	
				        	<input type="password" name="pwd" class="form-control" placeholder="New Password" required autofocus>
				        </div>
				        <input type="hidden" name="user" class="form-control" value="<?php echo $username; ?>">
				        
				        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Reset">
				    </form>


<?php 

			}
			else
			{
?>
							<div class="alert alert-warning alert-top text-center">
							    <!-- <button type="button" class="close" data-dismiss="alert">&times;</button> -->
							    <strong>Please enter the valid username</strong>
							    <br>
								<a href="login.php">Please Retry!</a>
							</div>

<?php			
			}
	}
	else
	{
?>

							<div class="alert alert-warning alert-top text-center">
							    <!-- <button type="button" class="close" data-dismiss="alert">&times;</button> -->
							    <strong>Please enter the valid username.</strong>
							    <br>
								<a href="login.php">Please Retry!</a>
							</div>

<?php
	}		
	
?>


</div>


<?php include_once($sitePath."/inc/_footer.php"); ?>
