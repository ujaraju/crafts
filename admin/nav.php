
   <nav class="navbar navbar-inverse">

       <div class="container"> 

          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $uri.'/home.php'; ?>">Beau Femme</a>
          </div>


        <div class="col-sm-3 col-md-3">
            <!-- <form class="navbar-form" method="GET" action="search.php">      
              <div class="input-group">
                <input type="text" class="form-control" name="query" placeholder="Search for..." required>
                <span class="input-group-btn">
                  <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
              </div>
            </form> -->
        </div>


          <div id="navbar" class="collapse navbar-collapse navbar-right">

            <ul class="nav navbar-nav">
              <!-- <li class="active"><a href="<?php echo $uri.'/home.php'; ?>">Home</a></li> -->
              <!-- <li><a href="<?php echo $uri.'/account.php'; ?>">update account</a></li> -->
              <li><a href="<?php echo $uri.'/inventory.php'; ?>">Products</a></li>
              <li><a href="<?php echo $uri.'/category.php'; ?>">Categories</a></li>
              <li><a href="<?php echo $uri.'/logout.php'; ?>">Log Out</a></li>
            </ul>
          </div><!--/.nav-collapse -->



      </div>
      
    </nav>

<div class="container">
