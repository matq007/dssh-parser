<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>DSSH Parser</title>

	<!-- Bootstrap core CSS -->
	<link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<style>
	  body 
	  {
		padding-top: 70px;
	  }
      /* hide original list counter */
      #treeNav ul li {display:block;}
      /* OR */
      #treeNav ul {list-style:none;}

	</style>

  </head>

  <body>
	<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
	  <div class="container">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#">DSSH Parser</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
		  <ul class="nav navbar-nav">
			<li class="active"><a href="#">Home</a></li>
		  </ul>
		</div><!-- /.nav-collapse -->
	  </div><!-- /.container -->
	</nav><!-- /.navbar -->

	<div class="container pulldown">
	  
	  <div class="col-lg-4" id="treeNav">
		<?php
            error_reporting(E_ALL);
            include "directory.php";
            listDir($path, $hidden);
        ?>
	  </div>

      <div class="col-lg-8">

      </div>


	</div>  <!-- -/. container -->

  <script src="assets/js/jquery-2.1.1.min.js"></script>
  <script src="lib/treeView.js"></script>

  <script>

      $(document).ready(function() {
          $("#treeNav li.folder").siblings("ul").toggle();
      });

      $("#treeNav li.folder").click(function(){
          $(this).next("ul").toggle();
          $(this).find("span").toggleClass("glyphicon-folder-close glyphicon-folder-open");
      });

  </script>



  </body>
</html>