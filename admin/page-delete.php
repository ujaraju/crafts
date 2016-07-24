<?php
session_start();
ob_start();

if (!isset($_SESSION["manager"])) {
  header("location:login.php");
  exit();
}
  $sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";
?>

<?php //include_once($sitePath."/inc/_header.php"); ?>
<?php //include_once($sitePath."/admin/nav.php"); ?>
<?php include_once($sitePath."/inc/_dbconnect.php"); ?>

<!-- delete item-->
<?php

if(isset($_GET['deleteid'])){
  $itemid_todelete = $_GET['deleteid'];
  

$sql= "SELECT * FROM products where product_id = '$itemid_todelete' LIMIT 1";
$result = mysqli_query($con, $sql);
$itemcount = mysqli_num_rows($result);
if ($itemcount>0) {
  while ($row = mysqli_fetch_array($result)) {
        $itemName= $row["product_name"];
?>


      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete product</h4>
      </div>

      <div class="modal-body">
          Are you sure you want to delete <strong><?php echo $itemName; ?></strong> ?
      </div>

      <div class="modal-footer">
        <div class="btn-group">
           <a class="btn btn-sm btn-danger" href="<?php echo 'inventory-delete.php?yesdelete='.$_GET['deleteid'] ; ?>"> Yes </a>
          <a class="btn btn-sm btn-success" href="inventory.php">No</a>
        </div>
      </div>



<?php
    }
  }
}
//exit();
?>


<?php
if(isset($_GET['yesdelete'])) {
  //remove item from the database
  $itemid_todelete = $_GET['yesdelete'];
  $sql = "DELETE FROM products WHERE product_id='$itemid_todelete' LIMIT 1";
  $result = mysqli_query($con, $sql);
  header("location: inventory.php");
}
?>
<!-- delete item-->


