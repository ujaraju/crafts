<?php
  session_start();
  ob_start();
  $sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";
?>

<?php include_once($sitePath."/inc/_header.php"); ?>
<?php include_once($sitePath."/user/nav.php"); ?>
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
if ($itemcount>0) {
?>


<div class="row">
<?php
      while ($row = mysqli_fetch_array($result)) {
          $itemId = $row["product_id"];
          $itemName= $row["product_name"];
          $itemDesc= $row["product_description"];
          $itemPrice= $row["price"];
          $itemCategoryID= $row["category_id"];
          //$itemCategoryName= $row["category_name"];
          $itemImage = $host.'media/products/small/'.$itemId.'.jpg';
  ?>

        <div class="col-xs-6 col-sm-6 col-md-3">

            <div class="product text-center">
                <figure class="img-responsive">
                    <a  href="<?php echo 'product.php?itemId='.$itemId; ?> ">
                      <img class="img-responsive" src="<?php echo  $itemImage; ?>" >
                    </a>

                    <!-- <div class="shadow"></div> -->
                    <figcaption class="text-center">
                          
                      <a  href="<?php echo 'product.php?itemId='.$itemId; ?> ">
                        <?php echo $itemName; ?>      
                      </a>

                    </figcaption>

                </figure>
                <div class="product-meta">
                  <div class="price">$ <?php echo $itemPrice; ?></div>
                  <div class="action">
                      <a class="btn btn-link"  href="<?php echo 'cart.php?itemId='.$itemId; ?> ">
                        add to cart
                      </a>
                  </div>
                </div>
                
            </div>

        </div>     

  <?php      
      }
?>

</div>
<?php
    } else {
      echo ('No products to display');
    }
  
?>



<?php include_once($sitePath."/inc/_footer.php"); ?>