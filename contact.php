<?php
  session_start();
  ob_start();
  $sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";
?>

<?php include_once($sitePath."/inc/_header.php"); ?>
<?php include_once($sitePath."/user/nav.php"); ?>


<h1>Contact us<h1>

<?php include_once($sitePath."/inc/_footer.php"); ?>