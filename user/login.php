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

                  $username = trim($_POST['username']); 
                  $password = trim($_POST['password']); 
                   
                  if(!empty($username) && !empty($password) )
                  {
                    $query = "SELECT user_name FROM users where user_name = '$username' and password = '$password'";
                    $result = mysqli_query($con, $query);

                      if( mysqli_num_rows($result) == 1 ){
                        $_SESSION['user'] = $username;
                        setcookie('user', $row['user'], time() + (60 * 60 * 24 * 30) );// expires in 30 days
                        header("location:home.php");
    
                      }else{ 
                  ?>

                      <div class="alert alert-danger text-center">
                          <!-- <button type="button" class="close" data-dismiss="alert">&times;</button> -->
                          <p><strong>Login Failed! Try Again! </strong><br></p>
                            <a class="btn btn-link" href="account.php">Please Try Again.</a>
                      </div>

                <?php   
                    }     
                  }

                ?>



    </div><!-- row-->

</div>



<?php include_once($sitePath."/inc/_footer.php"); ?>
