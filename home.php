<?php
  session_start();
  ob_start();
  $sitePath = $_SERVER['DOCUMENT_ROOT']."";
?>

<?php include_once($sitePath."/inc/_header.php"); ?>
<?php include_once($sitePath."/user/nav.php"); ?>



<?php
  $mediaCMS = $host."media/cms/"; 
?>


</div><!-- close the container that started on header-->
<!-- to make slideshow full width -->

<div class="slideshow">
    <img src="<?php echo $mediaCMS.'slide0.jpg' ?>"/>
    <img src="<?php echo $mediaCMS.'slide1.jpg' ?>"/>
    <img src="<?php echo $mediaCMS.'slide2.jpg' ?>"/>
</div>


<div class="container buckets">
	
	<div class="row">
	 <?php echo $catBuckets; // see user/nav.php?>
	</div>

</div>

<?php include_once($sitePath."/inc/_footer.php"); ?>