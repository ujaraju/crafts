
</div> <!-- container -->




<!-- get the categories and its contents -->
<?php
  $sql= "SELECT * FROM pages";
  $result = mysqli_query($con, $sql);
  $itemcount = mysqli_num_rows($result);
  $pageIDs=array();
  
  if ($itemcount>0) {
    while ($row = mysqli_fetch_array($result)) {
        $pageIDs[] = $row['page_id'];// adding all the categories in an array        
      }
  } 

  $pagelist=""; // for menu 


  foreach ($pageIDs as $pageID) { // loop throuigh each page to get the list of page names for menu 
      $sql0= "SELECT * FROM pages WHERE page_id = $pageID";
      //print_r($sql1);
      $result0 = mysqli_query($con, $sql0);
      $itemcount0 = mysqli_num_rows($result0);
      
      if ($itemcount0>0) { // display categories
        while ($row0 = mysqli_fetch_array($result0)) {
            $pageName= $row0["page_name"];
            $pageDescription= $row0["page_description"];

            $pagelist.="<li><a href='".$host."page.php?pageID=$pageID'>".$pageName."</a></li>";
        }
      }
  }
?>



<footer>
	<div class="container">
		<div class="row">
			<div class="col-sm-5">&copy; 2015 Beau Femme. all rights reserved.</div>
			
			<div class="col-sm-2 text-center">
				<ul class="list-inline">
					<!-- <li>Follow us</li> -->
					<li><a href="#"><i class="fa fa-instagram"></i></a></li>
					<li><a href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
				</ul>
			</div>

			<div class="col-sm-5 text-right">
				<ul class="list-inline">
					<li><a href="<?php echo $host."admin"; ?>">Admin</a></li>
					<?php echo $pagelist; ?>
					<li><a href="<?php echo $host."contact.php"; ?>">Contact</a></li>
				</ul>
			</div>


		</div>
	</div>
</footer>




<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> 
<!-- /.modal -->




<body>