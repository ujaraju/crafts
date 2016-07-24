<?php
session_start();
ob_start();

if (!isset($_SESSION["user"])) {
  	header("location:account.php");
 	exit();
}

$sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";
$username = $_SESSION["user"];
?>

<?php include_once($sitePath."/inc/_header.php"); ?>
<?php include_once($sitePath."/user/nav.php"); ?>
<?php include_once($sitePath."/inc/_dbconnect.php"); ?>

	<div class="row m-y-md">
		<div class="col-sm-2">
			<div class="list-group">	
					<a href="#" class="list-group-item active">Profile</a>  
				  	<a href="#" class="list-group-item">Orders</a>
				  	<a href="#" class="list-group-item">Wishlist</a>
				  	<a href="#" class="list-group-item">Cart</a>
				  	<a href="logout.php" class="list-group-item">Logout</a>
			</div>
		</div>
		<div class="col-sm-9 col-sm-offset-1">


<?php
    //TO TO
      $sql= "SELECT * FROM users WHERE user_name = $username";
      $result = mysqli_query($con, $sql);
      $itemcount = mysqli_num_rows($result);

?>

            <form class="form-signin" method ="post" action = "newaccount.php" >
                  <h2 class="form-signin-heading">Welcome, <?php echo $username; ?>!</h2>
                  
                  <div class="form-group">
                    <label for="usr" class="sr-only">Username</label>
                    <input type="text" name="usr" class="form-control" placeholder="Username" required autofocus>
                  </div>

                  <div class="form-group">
                    <label for="pass" class="sr-only">Password</label>
                    <input type="password" name="pass" class="form-control" placeholder="Password" required>
                  </div>

                  <div class="form-group">
                    <label for="fname" class="sr-only">First Name</label>
                    <input type="text" name="fname" class="form-control" placeholder="First Name" required autofocus>
                  </div>

                  <div class="form-group">
                    <label for="lname" class="sr-only">Last Name</label>
                    <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                  </div>

                  <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Email" required autofocus>
                  </div>

                  <div class="form-group">
                    <label for="address" class="sr-only">Address</label>
                    <input type="text" name="address" class="form-control" placeholder="Address" required>
                  </div>

                  <div class="form-group">
                    <label for="zip" class="sr-only">Zip</label>
                    <input type="text" name="zip" class="form-control" placeholder="Zip" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="phone" class="sr-only">Phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="Phone">
                  </div>
                  
                  <div class="form-group">
                    <label for="comments" class="sr-only">Comments</label>
                    <input type="textarea" name="comments" class="form-control">
                  </div>

                  <input class="btn btn-primary" type="submit" value="Update">
              </form>

		</div>
	</div>


<?php include_once($sitePath."/inc/_footer.php"); ?>
