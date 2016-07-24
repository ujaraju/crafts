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
<?php include_once($sitePath."/inc/_dbconnect.php"); ?>


<h1>Manage category 
  <a class="btn btn-default" href='<?php echo "category-add.php"; ?>' data-toggle="modal" data-target="#myModal"> Add new category</a>
</h1>



  <?php

  $sql= "SELECT * FROM categories";
  $result = mysqli_query($con, $sql);
  $itemcount = mysqli_num_rows($result);
  $categoryIDs=array();
  if ($itemcount>0) {
    while ($row = mysqli_fetch_array($result)) {
        $categoryIDs[] = $row['category_id'];// adding all the categories in an array        
      }
  } 
  else {
  ?>
   <div class="alert alert-danger">No categories to display</div>
  <?php

  }

  ?>



<div class="panel panel-default">

      <div class="panel-heading hidden-xs">
        <div class="row hidden-xs">
            <div class="col-sm-1"><strong>ID</strong>                         </div>
            <div class="col-sm-3"><strong>Category Name</strong>              </div>
            <div class="col-sm-2"><strong>Category Description</strong>       </div>
        </div>
      </div>

    <div class="list-group" role="tablist" aria-multiselectable="true">



<?php
  foreach ($categoryIDs as $catID) { // loop throuigh each category 


      $sql0= "SELECT * FROM categories WHERE category_id = $catID";
      //print_r($sql1);
      $result0 = mysqli_query($con, $sql0);
      $itemcount0 = mysqli_num_rows($result0);
      
      $categoryName="";
      $categoryDescription= "";

      if ($itemcount0>0) { // display categories
        while ($row0 = mysqli_fetch_array($result0)) {
            
            $categoryName= $row0["category_name"];
            $categoryDescription= $row0["category_description"];

        }
      }

?>

<div class="list-group-item">
 
 
    
        <div class="row">
            <div class="col-sm-1"><?php echo $catID; ?>                    </div>
            <div class="col-sm-3"><?php echo $categoryName; ?>             </div>
            <div class="col-sm-6"><?php echo $categoryDescription; ?>      </div>

            <div class="col-sm-2 ">

              <div class="btn-group btn-group-sm text-right">
                <a class="btn btn-link" href='<?php echo "category-delete.php?deleteid=$catID"; ?>' data-toggle="modal" data-target="#myModal">
                  <i class="glyphicon glyphicon-trash"></i>
                </a>
                <a class="btn btn-link" href='<?php echo "category-edit.php?itemid=$catID"; ?>' data-toggle="modal" data-target="#myModal"> 
                   <i class="glyphicon glyphicon-pencil"></i>
                </a>
              </div>

                <a class="list-group-item-heading collapsed pull-right" role="button" data-toggle="collapse" href="#<?php echo $catID ?>" aria-expanded="true" aria-controls="<?php echo $catID ?>"></a> 

            </div> 
        </div> 




    <div id="<?php echo $catID ?>" class="list-item-collapse collapse" role="tabpanel">

  <?php
        $sql1= "SELECT * FROM products WHERE category_id = $catID";
        //print_r($sql1);
        $result1 = mysqli_query($con, $sql1);
        $itemcount1 = mysqli_num_rows($result1);

            if ($itemcount1 > 0) { // display prodicts in that category
  ?>
        <!-- <h4>Products in this </h4> -->
        <table class="table table-bordered table-condensed m-y">
        <thead>
            <tr>
              <td>ID</td>
              <td>Product Name</td>
              <td>Price</td>
            </tr>
        </thead>    
  <?php 
                while ($row1 = mysqli_fetch_array($result1)) {
                $itemId = $row1["product_id"];
                $itemName= $row1["product_name"];
                $itemDesc= $row1["product_description"];
                $itemPrice= $row1["price"];
                //$itemCategoryID= $row1["category_id"];
                //$itemCategoryName= $row1["category_name"];
  ?>
    
            <tr>
              <td><?php echo   $itemId; ?></td>
              <td><?php echo   $itemName; ?></td>
              <td><?php echo   "$ ".$itemPrice; ?></td>
            </tr>

        

  <?php

                  }
              
  ?>  
      
      </table>  

  <?php
  }
    else 
  {
  ?>

        <div class="alert alert-danger">No Products to display in this category</div>

  <?php
    }
  ?>


      </div>
    </div>

<?php   
  }
?>


</div>

</div>






<?php include_once($sitePath."/inc/_footer.php"); ?>
