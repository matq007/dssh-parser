<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="Martin Proks">

	<title>DSSH Parser</title>

	<!-- Bootstrap core CSS -->
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/style.css" rel="stylesheet">

	<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

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
	  
	  <div class="col-lg-3" id="treeNav">
		<?php
			error_reporting(E_ALL);
			include "directory.php";
			listDir($path, $hidden);
		?>
	  </div>

	  <p class="col-lg-9 terminal-top-bar">Welcome to DSSH</p>
	  <div class="col-lg-9 terminal">
	  	<div id="parsedText">
	  		<p class="console"><span id="caption"></span><span id="cursor">|</span></p>
	  	</div>
	  </div>


	</div>  <!-- -/. container -->

  <script src="assets/js/jquery-2.1.1.min.js"></script>
  <script src="lib/Parser.js"></script>

  <script>

  		var data  = [];
  		var timer = [];

		$(document).ready(function() {
			$("#treeNav li.folder").siblings("ul").toggle();
			setInterval ('cursorAnimation()', 600);

		});

		$("#treeNav li.folder").click(function(){
		  $(this).next("ul").toggle();
		  $(this).find("span").toggleClass("glyphicon-folder-close glyphicon-folder-open");
		});

		$("#treeNav li.file").click(function(){
			var file   = $(this).attr('value');
			$(".terminal-top-bar").text(file);
			loadFile(file);
			//console.log(result);
			//$("#parsedText").html(result);	
		});



  </script>



  </body>
</html>