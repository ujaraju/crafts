 <?php
  session_start();
  ob_start();
  $sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";

  $mediaProducts = $sitePath."/media/products/"; 

?>

<?php include_once($sitePath."/inc/_header.php"); ?>
<?php include_once($sitePath."/user/nav.php"); ?>
<?php include_once($sitePath."/inc/_dbconnect.php"); ?>







<?php
//Display chosen menu item
if(isset($_GET['catID'])) {
  $cat_ID = $_GET['catID'];

  $sql1= "SELECT * FROM categories where category_id = '$cat_ID'";
  $result1 = mysqli_query($con, $sql1);
  $itemcount1 = mysqli_num_rows($result1);
  


  //echo "<h1>".$iid."</h1>"; 
  $sql= "SELECT * FROM products where category_id = '$cat_ID'";
  $result = mysqli_query($con, $sql);
  $itemcount = mysqli_num_rows($result);

  if ($itemcount > 0) { // display prodicts in that category

      $data = array();
      while ($row = mysqli_fetch_array($result)) {


        $data[] = array(
                  'id' => $row["product_id"],
                  'name' => $row["product_name"],
                  'price' => $row["price"],
                  'description' => utf8_encode ($row["product_description"]),
                  'cat' =>  $row["category_id"],
                  'category' => $row["category_name"],
                  );
      }
    } else {
      echo ('No products to display');
    }

}
?>




<div ng-app="myApp">

<?php 
  if ($itemcount1 > 0) { 
      while ($row1 = mysqli_fetch_array($result1)) { 
?>
  <h1>
    <?php echo $row1["category_name"]; ?>
    <a href="#" class="btn btn-default pull-right" ng-click="sortType = 'price'; sortReverse = !sortReverse">
      Sort by price  
      <span ng-show="sortType == 'price' && !sortReverse" class="fa fa-caret-down"> High to Low</span>
      <span ng-show="sortType == 'price' && sortReverse" class="fa fa-caret-up"> Low to High</span>
    </a>
  </h1>
<?php  
      }
  }
?>

<div class="row" ng-controller="myCtrl">

      <div class="col-xs-6 col-sm-6 col-md-3" ng-repeat="x in records | orderBy:sortType:sortReverse">
        

            <div class="product text-center">
                <figure class="img-responsive">
                    <a  href="<?php echo 'product.php?itemId='?>{{x.id}}">
                      <img class="img-responsive" src="<?php echo  $host; ?>/media/products/{{x.id}}.jpg" >
                    </a>

                    <!-- <div class="shadow"></div> -->
                    <figcaption class="text-center">

                      <a  href="<?php echo 'product.php?itemId='; ?>{{x.id}} ">
                        {{x.name}}
                      </a>

                    </figcaption>

                </figure>
                <div class="product-meta">
                  <div class="price">{{x.price | currency}}</div>
                  <div class="action">
                      <a class="btn btn-link"  href="<?php echo 'cart.php?itemId='; ?> {{x.id}}">
                        add to cart
                      </a>
                  </div>
                </div>
                
            </div>
      </div>


</div>


</div>



<script>
var app = angular.module("myApp", []);
app.controller("myCtrl", function($scope) {

  $scope.sortType     = 'price';     // set the default sort type
  
  $scope.records = <?php echo $jsonformat=json_encode($data); ?> 
    
});
</script>


<?php include_once($sitePath."/inc/_footer.php"); ?>


