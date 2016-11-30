<?php
  session_start();
  ob_start();
  $sitePath = $_SERVER['DOCUMENT_ROOT']."";

  $mediaCMS = $sitePath."/media/cms/"; 

?>

<?php include_once($sitePath."/inc/_header.php"); ?>
<?php include_once($sitePath."/user/nav.php"); ?>
<?php include_once($sitePath."/inc/_dbconnect.php"); ?>







<?php
//Display chosen menu item
if(isset($_GET['pageID'])) {
  $page_ID = $_GET['pageID'];

  //echo "<h1>".$iid."</h1>"; 
  $sql= "SELECT * FROM pages where page_id = '$page_ID'";
  $result = mysqli_query($con, $sql);
  $itemcount = mysqli_num_rows($result);

  if ($itemcount > 0) { // display page
?>

<?php
      while ($row = mysqli_fetch_array($result)) {
          $itemId = $row["page_id"];
          $itemName= $row["page_name"];
          $itemDesc= $row["page_description"];

          //$itemImage = $mediaCMS.$itemId.'.jpg';
  ?>

    
          
          <?php //echo $itemImage; ?>
        
          <h1><?php echo $itemName; ?></h1>      
       
          <?php echo $itemDesc; ?>      

      
  <?php      
      }
?>


<?php
    } else {
      echo ('No page to display');
    }
  
  }
?>





<?php include_once($sitePath."/inc/_footer.php"); ?>
