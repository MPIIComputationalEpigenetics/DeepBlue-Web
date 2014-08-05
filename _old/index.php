<?php
    include 'lib/functions.php';
    $main = new Main();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>DeepBlue :: HiWi Task</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet"> 

        <!--Font-->
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600' rel='stylesheet' type='text/css'>


        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- ICON -->
        <link rel="shortcut icon" href="img/ico_16.ico">

        <!-- SCRIPT -->  
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
      
    </head>
    <body>      
  
    <!--HEADER ROW-->
  
        <div id="header-row">
          <div class="container">
            <div class="row">
                    <!--LOGO-->
                    <div class="span3"><a class="brand" href="."><img src="img/deepblue_alt.png" class="logo"/></a></div>
                    <!-- /LOGO -->

                  <!-- MAIN NAVIGATION -->  
                    <div class="span9">
                      <div class="navbar  pull-right">
                        <div class="navbar-inner">
                          <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a>
                          <div class="nav-collapse collapse navbar-responsive-collapse">
                          <ul class="nav">
                              <li <?php if(!$_GET['page']){echo "class='active'";} ?>><a href="index.php">Home</a></li>
                              <li <?php if($_GET['page'] == 'version'){echo "class='active'";} ?>><a href="?page=version">DeepBlue Version</a></li>
                              <li <?php if($_GET['page'] == 'api'){echo "class='active'";} ?>><a href="?page=api">API</a></li>
                              <li <?php if($_GET['page'] == 'experiment'){echo "class='active'";} ?>><a href="?page=experiment">Experiments</a></li>

                          </ul>
                        </div>

                        </div>
                      </div>
                    </div>
                    <!-- MAIN NAVIGATION -->  
            </div>
          </div>
        </div>
        <!-- /HEADER ROW -->

        <div class="container">
            <?php $main->changeContent($_GET['page']);?>
            <div class="hr-divider"></div>
        </div>
        
        <!-- /.Row View -->

    <!-- Footer -->

    <footer>
        <div class="container">
          <div class="row">
            <div class="span6">&copy 2014 Max Planck Institut for Computer Science<br>
                <small>Saarland University</small>
            </div>
            <div class="span6">
                <div class="social pull-right">
                    <a href="#"><img src="img/social/googleplus.png" alt=""></a>
                    <a href="#"><img src="img/social/dribbble.png" alt=""></a>
                    <a href="#"><img src="img/social/twitter.png" alt=""></a>
                    <a href="#"><img src="img/social/dribbble.png" alt=""></a>
                    <a href="#"><img src="img/social/rss.png" alt=""></a>
                </div>
            </div>
          </div>
        </div>
    </footer>

    <!--/.Footer-->

    </body>
</html>
