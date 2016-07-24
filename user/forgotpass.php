<?php
  
  $sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";
  
?>

<?php include_once($sitePath."/inc/_header.php"); ?>
<?php include_once($sitePath."/user/nav.php"); ?>
<?php include_once($sitePath."/inc/_dbconnect.php"); ?>


<div class="form-account m-y-lg">


	<h2>Change password</h2>
					 
	<form class="" method ="post" action = "forgotpass1.php" >			        
	    <div class="form-group">
	    	<input type="text" name="user" class="form-control" placeholder="Enter username to verify" required autofocus>
	    </div>
	    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Verify">
	</form>


</div>



<?php include_once($sitePath."/inc/_footer.php"); ?>

