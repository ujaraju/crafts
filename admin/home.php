<?php
session_start();
ob_start();

if (!isset($_SESSION["manager"])) {
  header("location:login.php");
  exit();
}
  $sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";
?>

<?php include_once($sitePath."/inc/_header.php"); ?>
<?php include_once($sitePath."/admin/nav.php"); ?>

	
	<img class="img-responsive" src="<?php echo $host.'media/cms/dashboard.jpg'; ?>"/>

<?php include_once($sitePath."/inc/_footer.php"); ?>
