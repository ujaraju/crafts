<?php 
  $sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";
?>



<?php include_once($sitePath."/inc/_dbconnect.php"); ?>

<?php
  $mediaCategories = $host."media/categories/"; 
  $thumbMediaCategories = $host.'media/categories/thumb/'; 
?>


<?php  // welcome message
  $usermenu="";
  if (!isset($_SESSION["user"])) {
      $usermenu = "<li><a href='".$host."user/account.php'>Log in</a></li>";
  }
  else{
       $usermenu = "<li>Welcome!</li>
                    <li><a href='".$host."user/account.php'>Account</a></li>
                    <li><a href='".$host."user/logout.php'>Log out</a></li>";
  }

?>



<!-- get the categories and its contents -->
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

  $catlist=""; // for menu 
  $catBuckets="";

  foreach ($categoryIDs as $catID) { // loop throuigh each category to get the list of category names for menu 
      $sql0= "SELECT * FROM categories WHERE category_id = $catID";
      //print_r($sql1);
      $result0 = mysqli_query($con, $sql0);
      $itemcount0 = mysqli_num_rows($result0);
      
      if ($itemcount0>0) { // display categories
        while ($row0 = mysqli_fetch_array($result0)) {
            $categoryName= $row0["category_name"];
            $categoryDescription= $row0["category_description"];

            $catlist.="<li><a href='".$host."category.php?catID=$catID'>".$categoryName."</a></li>";

            $catBuckets.="<div class='col-sm-4 text-center'><figure>".
                            "<a href='category.php?catID=".$catID."'><img class='img-responsive' src='".$mediaCategories.$catID.".jpg".
                            "'/></a>". 
                            "<figcaption>".$categoryDescription.
                            "</figcaption></figure></div>";
            //$catBuckets.="<div class='col-sm-3'><a href='category.php?catID=".$catID."'><figure><img src='". $host.'media/categories/'.$itemId.'.jpg';."'/><figcaption>".$categoryDescription."</figcaption></figure></a></div>";
        }
      }
  }
?>



<!-- get the categories and its contents -->



<nav class="navbar navbar-default ">
  
<div class="container">
  <div class="row">
    <div class="col-sm-6">

          <div class="branding">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?php echo $host.'home.php'; ?>">Beau Femme</a>
            </div>



            <form class="navbar-form" method="GET" action="search.php">   
              <div class="input-group">
                <input type="text" class="form-control" name="query" placeholder="Search products..." required>
                <span class="input-group-btn">
                  <button class="btn btn-link" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
              </div><!-- /input-group -->
            </form>
        </div>

    </div>
    
    <div class="col-sm-6">
      <div class="topnav">
       <ul class="list-inline text-right m-a-0">
          <?php echo $usermenu; ?>
          <li class=""><a href="<?php echo $host.'cart.php';?> "><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
<!--            <li class=""><a href="<?php echo $host.'user/account.php';?>"><?php echo $salutation; ?></a></li>
           <li class=""><a href="<?php echo $host.'cart.php';?> "><span class="glyphicon glyphicon-shopping-cart"></span></a></li> -->
       </ul>
      </div>

      <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav navbar-right">
                  <?php echo $catlist; ?>
            </ul>
      </div><!-- /.navbar-collapse -->

    </div>

  </div>
</div>

</nav>




<div class="shadow"></div>

<div class="container">

<!-- 

          <div class="row">
            <div class="col-sm-6">
              <ul class="list-inline m-a-0">
                  <li class=""><a href="http://facebook.com"> <i class="fa fa-facebook"></i></a></li>
                  <li class=""><a href="http://instagram.com"><i class="fa fa-twitter"></i></a></li>
              </ul>
            </div>
            <div class="col-sm-6">
              <ul class="list-inline text-right m-a-0">
                  <li class=""><a href="<?php echo $host.'user/account.php';?>"><?php echo $salutation; ?></a></li>
                  <li class=""><a href="<?php echo $host.'cart.php';?> "><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
              </ul>
            </div>
        </div> -->