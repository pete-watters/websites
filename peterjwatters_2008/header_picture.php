<?php

session_start();

require("config.php");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta name="Description" content="Peter Watters B.Eng Homepage. This is my homepage and online portfolio. Please feel free to e-mail any comments to peter@peterjwatters.com" />

<meta name="Keywords" content="peter, watters, web, portfolio, DCU," />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Peter Watters - peterjwatters@gmail.com" />
<meta name="Robots" content="index,follow" />		

<link rel="stylesheet" href="images/EliteCircle.css" type="text/css" />

<title><?php echo $config_sitename; ?></title>
<script type="text/javascript" src="swfobject.js"></script>
<style type="text/css">	
	/* hide from ie on mac \*/
	html {
		height: 100%;
		overflow: hidden;
	}
	
	#flashcontent {
		height: 100%;
	}
	/* end hide */

	body {
		height: 100%;
		margin: 0;
		padding: 0;
		background-color: #181818;
		color:#ffffff;
	}
</style>	
</head>

<body>

<!-- header starts here -->
	<div id="header-wrap"><div id="header-content">	
		
		<h1 id="logo"><a href="index.php" title="">Peter<span class="orange">Watters</span></a></h1>	
		<h1 id="clock">
			<applet code="Dgclock.class" CODEBASE="http://peterjwatters.com/java-sys" width="100" height="30">
      					<param name="TimeFormat" value="">
   					<param name="ShowDate" value="no">
      					<param name="ShowFrame" value="yes">
      					<param name="fg" value="black">
      					<param name="bg" value="white">
      			</applet>
		<h2 id="slogan">Welcome to my online world....</h2>		
		
		<div id="header-links">
			<p>
				<a href="<?php echo $config_basedir; ?>index.php">Home</a> | 
				<a href="<?php echo $config_basedir; ?>contact.php">Contact</a> | 
				<a href="<?php echo $config_basedir; ?>sitemap.php">Site Map</a>			
			</p>		
		</div>
		

		<!-- Menu Tabs -->
		<ul>
			<li><a href="<?php echo $config_basedir; ?>index.php" id="current">Home</a></li>
			<li><a href="<?php echo $config_basedir; ?>wordpress">Blog</a></li>
			<li><a href="<?php echo $config_basedir; ?>pictures.php">Photos</a></li>
			<li><a href="<?php echo $config_basedir; ?>portfolio.php">Portfolio</a></li>
			<li><a href="<?php echo $config_basedir; ?>cv.php">CV</a></li>
			<li><a href="<?php echo $config_basedir; ?>projects.php">Projects</a></li>
			<li><a href="<?php echo $config_basedir; ?>support.php">Support</a></li>
			<li><a href="<?php echo $config_basedir; ?>about.php">About</a></li>			
		</ul>					
	
	</div>

</div>