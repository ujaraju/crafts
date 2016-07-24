<?php 
session_start();
ob_start();
?>


<?php include_once($sitePath."/inc/_header.php"); ?>
<?php //include_once($sitePath."/admin/nav.php"); ?>
<?php include_once($sitePath."/inc/_dbconnect.php"); ?>


<div class="container">



<form method="post" action="adminnewaccount.php">
<p> Username:
<input type="text" name="user" placeholder="admin username">
Password:
<input type="password" name="pwd" placeholder="admin password">
</p>
<p>
<input type="submit" value="Create Admin Account"></p>
</form>
<?php
 	// Connect to the database
   

			$username = trim($_POST['user']);
      		$password = trim($_POST['pwd']);
      		
      		
			if (!empty($username) && !empty($password)) {
        	//Store username and password in the database
       		$query = "INSERT INTO admins VALUES ('$username' , '$password')";
       		
       		$result = mysqli_query($con, $query);
       		
			echo('<h2> Dear, ' . $username. ' . Your Administrative Account has been successfully created!</h2>');  
       		
       		$query1 = "SELECT username FROM admins WHERE username = '$username' AND Password = '$password'";
        	$result1 = mysqli_query($con, $query1);
       		if (mysqli_num_rows($result1) == 1) {
           
    		echo('<h2>Login Successful!</h2><h3>You are logged in as ' . $username . '.</h3>');
       		
       		}
       		else {
       		echo('<p> Sorry, you must enter a valid username and password to create account.');
       		}
       		}
       		else {
       		echo('<p> Sorry, you must enter a valid username and password to create account.');
       		}
       		
?>

<?php include_once("_header.php"); ?>

</body>

</html>