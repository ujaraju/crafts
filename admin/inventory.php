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

<?php
$sql= "SELECT c.* , p.* FROM categories c,products p WHERE c.category_id=p.category_id ORDER BY `p`.`product_id` DESC ";
$result = mysqli_query($con, $sql);
$itemcount = mysqli_num_rows($result);
if ($itemcount>0) { 


$data = array();
    while($row = mysqli_fetch_assoc($result))
    {

        $data[] = array(
                  'id' => $row["product_id"],
                  'name' => $row["product_name"],
                  'price' => $row["price"],
                  'description' => utf8_encode ($row["product_description"]),
                  'cat' =>  $row["category_id"],
                  'category' => $row["category_name"],
                  );
    }


//echo $jsonformat=json_encode($data);

  } else {

    echo '<div class="alert alert-danger">No Products to display</div>';

  }
?>


<div ng-app="myApp">




  <h1>
    Manage Inventory 
    <a class="btn btn-default" href='<?php echo "inventory-add.php"; ?>' data-toggle="modal" data-target="#myModal"> Add new product</a>

    <form class="pull-right">
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search" ng-model="searchProducts">
          <div class="input-group-addon"><i class="fa fa-search"></i></div>
        </div>      
      </div>
    </form>

  </h1>
  








<hr>
<table class="table table-hover" ng-controller="myCtrl">

          <thead>
            <tr>
              <th>
                <a href="#" ng-click="sortType = 'id'; sortReverse = !sortReverse">
                  ID
                  <span ng-show="sortType == 'id' && !sortReverse" class="fa fa-caret-down"></span>
                  <span ng-show="sortType == 'id' && sortReverse" class="fa fa-caret-up"></span>
                </a>
              </th>

              <th>Image            </th>

              <th>
                <a href="#" ng-click="sortType = 'name'; sortReverse = !sortReverse">
                  Name 
                  <span ng-show="sortType == 'name' && !sortReverse" class="fa fa-caret-down"></span>
                  <span ng-show="sortType == 'name' && sortReverse" class="fa fa-caret-up"></span>
                </a>
              </th>

              <th>
                <a href="#" ng-click="sortType = 'category'; sortReverse = !sortReverse">
                  Category 
                  <span ng-show="sortType == 'category' && !sortReverse" class="fa fa-caret-down"></span>
                  <span ng-show="sortType == 'category' && sortReverse" class="fa fa-caret-up"></span>
                </a>
              </th>

              <th>
                <a href="#" ng-click="sortType = 'price'; sortReverse = !sortReverse">
                  Price 
                  <span ng-show="sortType == 'price' && !sortReverse" class="fa fa-caret-down"></span>
                  <span ng-show="sortType == 'price' && sortReverse" class="fa fa-caret-up"></span>
                </a>
              </th>

              <th>                 </th>

            </tr>
          </thead>



      <tbody>
      <tr ng-repeat="x in records | orderBy:sortType:sortReverse | filter:searchProducts" >
        

            <td>
              {{x.id}}
            </td>
          
            <td>
              <img class=" thumbnail img-responsive" 
              src="<?php echo $host.'media/products/thumb/'; ?>{{x.id}}.jpg " >
            </td>
            <td>
              {{x.name}}
            </td>

            <td>
              {{x.category}}
            </td>

            <td>
              {{x.price | currency}}
            <td>

            <td class="text-right">
              <div class="btn-group btn-group-sm">
                <a class="btn btn-default" href='<?php echo "inventory-delete.php?deleteid="; ?>{{x.id}}' data-toggle="modal" data-target="#myModal">
                  <i class="glyphicon glyphicon-trash"></i>
                </a>
                <a class="btn btn-default" href='<?php echo "inventory-edit.php?itemid="; ?>{{x.id}}' data-toggle="modal" data-target="#myModal"> 
                   <i class="glyphicon glyphicon-pencil"></i>
                </a>
              </div>
            </td>

      </tr>


</table>

</div>


<script>
var app = angular.module("myApp", []);
app.controller("myCtrl", function($scope) {

  $scope.sortType     = '';     // set the default sort type
  $scope.sortReverse  = false;  // set the default sort order
  $scope.search   = '';         // set the default search/filter term
  
  
  $scope.records = <?php echo $jsonformat=json_encode($data) ?> 
    
});
</script>

<?php include_once($sitePath."/inc/_footer.php"); ?>
