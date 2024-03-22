<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<title>404 Page Not Found</title>
<link href="assets/css/style.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/admin/fonts/static/fonts.css">
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px;
	font-family: 'Gelion';

	color: #4F5155;
	    min-height: inherit;
    position: inherit;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}



p {
	margin: 12px 15px 12px 15px;
}

.notfound
{
	    text-align: center;
  right:0;
    position: absolute;
    top: 35%;
    left: 0;

}

.notfound p
{
	width:100%;
	margin:0 auto;
	text-align:center;
}

.notfound h1
{
	width:100%;
	margin-top:5px;
	margin-bottom:0px;
	font-size:38px;
	color:#9E88B7;
	font-weight:400;
	
	text-align:center;
}

.notfound h4
{
	width:100%;
	margin:0 auto;
	font-size:23px;
	color:#220E0E;
	font-weight:400;
	
	text-align:center;
}

.notfound a{
font-size: 18px;
    color: #fff;
    margin-top: 29px;
    display: inline-block;
    BACKGROUND: #592D8D;
    text-decoration: none;
    height: 50px;
    line-height: 50px;
    padding: 0 70px;
	border-radius:4px;
}
</style>
</head>
<body>
	<div id="container" class="container">
	<div class="row">
	<div class="col-12">
	<div class="notfound">
	<img src="<?php echo base_url() ?>assets/images/notfound.svg"/>
		<h1>404</h1>
		<h4>Page not found</h4>
		<?php if(!$is_admin): ?>
			<a href="<?php echo base_url() ?>">Go Back To Home</a>
		<?php else: ?>
			<a href="<?php echo base_url().'admin' ?>">Go Back To Home</a>
		<?php endif; ?>
		</div>
		</div>
	</div>
</body>
</html>