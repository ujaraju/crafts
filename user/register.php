<?php
session_start();
ob_start();

  if (isset($_SESSION["user"])) { 
   header("location:home.php");
   exit();
  }
  
  $sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";
?>

<?php include_once($sitePath."/inc/_header.php"); ?>
<?php include_once($sitePath."/user/nav.php"); ?>
<?php include_once($sitePath."/inc/_dbconnect.php"); ?>

<div class="container m-y-md">


    <div class="row">




              <?php

              $clientUsername = trim($_POST['cUsername']);
              $clientPassword = trim($_POST['cPassword']);
              $clientEmail = trim($_POST['cEmail']);


              if ( (!empty ($clientUsername)) && ( !empty ($clientPassword) ) ){
                  //echo $clientUsername;
                            
                  $query = "INSERT INTO users (user_name, password, email) VALUES ('$clientUsername', '$clientPassword', '$clientEmail')";
                  
                  $result = mysqli_query($con, $query);
                  
                  if ( false===$result ) {
                      
               ?>
                      <div class="text-center">
                        <h1> :(</h1>
                        <h2>Sorry Account was not created.</h2>
                        <p>Please enter valid username, password and email address and <a href="<?php echo $uri.'/account.php'; ?>">try again</a></p>

                      </div>
               <?php
                  }else {
               ?>
              <div class="text-center">
                <h1> :)</h1>
                <h2>Welcome  <?php echo $clientUsername ?>, Your account has been created.</h2>
                <p>Please <a href="<?php echo $uri.'/account.php'; ?>">log in</a>.</p>

              </div>
              <?php
                  }
              };
              ?>




    </div><!-- row-->

</div>



<?php include_once($sitePath."/inc/_footer.php"); ?>


