<?php
	$sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";	
?>

<?php include_once($sitePath."/inc/_header.php"); ?>

<div class="form-account m-y-lg text-center">

        <div class="branding">
            
            <h2><a class="navbar-brand" href="<?php echo $host.'home.php'; ?>">Beau Femme</a></h2>

		</div>


	<h4>Verify user</h4>
					 
	<form class="" method ="post" action = "forgotpass1.php" >			        
	    <div class="form-group">
	    	<input type="text" name="user" class="form-control" placeholder="Enter username to verify" required autofocus>
	    </div>
	    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Verify">
	</form>


</div>



<?php include_once($sitePath."/inc/_footer.php"); ?>

