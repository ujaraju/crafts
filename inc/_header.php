<?php
//Error Reporting
   	error_reporting(E_ALL);
  	ini_set('display_errors', '0');
	//error_reporting(0);

	$host 	= 'http://'.$_SERVER['HTTP_HOST'].'/crafts/';
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
?>



<!DOCTYPE html>
<html>
<head>
	<title>Admin Control Panel</title>
	<!-- Latest compiled and minified CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Qwigley' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,600' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" type="text/css" href="<?php echo $host.'style.css'; ?>">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha256-Sk3nkD6mLTMOF0EOpNtsIry+s1CsaqQC1rVLTAy+0yc= sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
	<script src="<?php echo $host.'scripts/productZoom.js'; ?>" type="text/javascript"></script>
	<script src="<?php echo $host.'scripts/jquery.bxslider.min.js'; ?>" type="text/javascript"></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script> 

	<script src="<?php echo $host.'scripts/scripts.js'; ?>" type="text/javascript"></script>
</head>
<body >


    