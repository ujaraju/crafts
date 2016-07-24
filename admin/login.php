<?php
session_start();
ob_start();

	// if (isset($_SESSION["manager"])) { 
	// 	header("location:adminhome.php");
	// 	exit();
	// }
	
	$sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";
	
?>

<?php include_once($sitePath."/inc/_header.php"); ?>
<?php //include_once($sitePath."/admin/nav.php"); ?>
<?php include_once($sitePath."/inc/_dbconnect.php"); ?>


	<div class="form-account m-y-lg text-center">


        <div class="branding">
            
            <h2><a class="navbar-brand" href="<?php echo $host.'home.php'; ?>">Beau Femme</a></h2>

		</div>


      <form class="form-group" method ="post" action = "<?php echo $uri.'/login.php'; ?>" >
        
        <!-- <h2>Please sign in</h2> -->
        
        <div class="form-group">
	        <label for="username" class="sr-only">Username</label>
	        <input type="text" class="form-control" placeholder="username" name="user" required autofocus>
	        <label for="pwd" class="sr-only">Password</label>
	        <input type="password" class="form-control" placeholder="Password" name="pwd" required>
       	</div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      	
      </form>

      	<div class="text-center">
			<a href="<?php echo $uri.'/forgotpass.php'; ?> ">Forgot Password</a>
			<!-- <a class="pull-right" 	href="<?php echo $uri.'/newaccount.php'; ?> ">Create Account</a> -->
		</div>
    </div>


<?php
	$con = mysqli_connect('localhost','root','','crafts') OR die('Failed to connect to MySQL');

	$username = trim($_POST['user']); 
	$password = trim($_POST['pwd']); 
	 
	if(!empty($username) && !empty($password) )
	{
		$query = "SELECT username FROM admins where username = '$username' and password = '$password'";
		$result = mysqli_query($con, $query);
?>


<?php
	if( mysqli_num_rows($result) == 1 ){
		$_SESSION['manager'] = $username;
		setcookie('manager', $row['manager'], time() + (60 * 60 * 24 * 30) );// expires in 30 days
		header("location:home.php");
?>		
		
<?php			
	}
	else{	
?>
		<div class="alert alert-danger alert-top text-center" id="alert">
		    <button type="button" class="close" data-dismiss="alert">&times;</button>
		    <strong>Login Failed! Try Again! </strong>
		    Please Try Again.
		</div>

<?php		
	}			
}
?> 

<?php include_once($sitePath."/inc/_footer.php"); ?>

</body>

</html>