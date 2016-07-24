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


       

        <div class="col-sm-6">

          <div class="form-account">
              
              <form method ="post" action="login.php">
                
                <h2>Please log in</h2>
                
                <div class="form-group">
                  <label for="username" class="sr-only">Username</label>
                  <input type="text" class="form-control" placeholder="username" name="username" required autofocus>
                  <label for="password" class="sr-only">Password</label>
                  <input type="password" class="form-control" placeholder="password" name="password" required>
                </div>
                <div class="form-group">
                  <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
                </div>
              </form>

              <div class="text-center">
                <a href="<?php echo $uri.'/forgotpass.php'; ?> ">Forgot Password</a>
              </div>

          </div>

        </div><!-- log in -->






        <div class="col-sm-6">
          <div class="form-account">
            <form method ="post" action="register.php">
                  <h2>Create an account</h2>
                  
                  <div class="form-group">
                    <label for="cUsername" class="sr-only">Username</label>
                    <input type="text" name="cUsername" class="form-control" placeholder="username" required autofocus>



                    <label for="cPassword" class="sr-only">Password</label>
                    <input type="password" name="cPassword" class="form-control" placeholder="password" required>



                    <label for="cEmail" class="sr-only">Email</label>
                    <input type="text" name="cEmail" class="form-control" placeholder="email" required autofocus>
                  </div>

                  <div class="form-group text-right">
                    <button class="btn btn-primary btn-block btn-lg" type="submit">
                      Register
                    </button>
                  </div>
              </form>

            </div>
        </div>






    </div><!-- row-->

</div>



<?php include_once($sitePath."/inc/_footer.php"); ?>



