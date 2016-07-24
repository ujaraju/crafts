<?php
  session_start();
  ob_start();
  $sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";
?>

<?php include_once($sitePath."/inc/_header.php"); ?>
<?php include_once($sitePath."/admin/nav.php"); ?>
<?php include_once($sitePath."/inc/_dbconnect.php"); ?>



<?php

  $query = $_GET['query']; 
  $query = htmlspecialchars($query);


  $sql= "SELECT * FROM products
            WHERE (product_name LIKE '%".$query."%') OR (product_description LIKE '%".$query."%')";

  $result = mysqli_query($con, $sql);
  $itemcount = mysqli_num_rows($result);

?>

<h1>Search result(s) for: <?php echo $query; ?> </h1>


<?php
$itemcount = mysqli_num_rows($result);
if ($itemcount>0) {

?>
  
<div class="panel panel-default">

      <div class="panel-heading hidden-xs">
        <div class="row hidden-xs">
            <div class="col-sm-1"><strong>ID</strong>               </div>
            <div class="col-sm-2"><strong>Image</strong>            </div>
            <div class="col-sm-3"><strong>Name</strong>             </div>
            <div class="col-sm-2"><strong>Category</strong>         </div>
            <div class="col-sm-2"><strong>Price</strong>            </div>
            <div class="col-sm-2">                                  </div>
        </div>
      </div>

    <div class="list-group">
    <?php
    while ($row = mysqli_fetch_array($result)) {
          
          $itemId = $row["product_id"];
          $itemName= $row["product_name"];
          $itemDesc= $row["product_description"];
          $itemPrice= $row["price"];
          $itemCategoryID= $row["category_id"];
          $itemCategoryName= $row["category_name"];
          $itemImage = $host.'media/products/thumb/'.$itemId.'.jpg';
    ?>

      <div class="list-group-item">
        <div class="row">

            <div class="col-sm-1">
              <?php echo $itemId; ?>
            </div>
          
            <div class="col-sm-2">
              <img class=" thumbnail img-responsive" src="<?php echo  $itemImage; ?>" >
            </div>
            <div class="col-sm-3">
              <?php echo $itemName; ?>      
            </div>

            <div class="col-sm-2">
              <?php echo $itemCategoryName; ?>
            </div>

            <div class="col-sm-2">
              <?php echo $itemPrice; ?>
            </div>

            <div class="col-sm-2 text-right">
              <div class="btn-group btn-group-sm">
                <a class="btn btn-default" href='<?php echo "inventory-delete.php?deleteid=$itemId"; ?>' data-toggle="modal" data-target="#myModal">
                  <i class="glyphicon glyphicon-trash"></i>
                </a>
                <a class="btn btn-default" href='<?php echo "inventory-edit.php?itemid=$itemId"; ?>' data-toggle="modal" data-target="#myModal"> 
                   <i class="glyphicon glyphicon-pencil"></i>
                </a>
              </div>
            </div>
        </div>
      </div>
    <?php          
     }
    ?>
    </div>


</div>

<?php
} else {
?>
 <div class="alert alert-danger">:)<br>No Products found. Please try again!</div>
<?php
}
?>



<?php include_once($sitePath."/inc/_footer.php"); ?>