<?php

session_start();

require("config.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta name="Description" content="Peter Watters B.Eng MIEI Homepage. This is my homepage and online portfolio. Please feel free to e-mail any comments to peter@peterjwatters.com" />
<meta name="Keywords" content="peter watters web portfolio DCU" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Peter Watters - peter@peterjwatters.com" />
<meta name="Robots" content="index,follow" />		

<link rel="stylesheet" href="css/style.css" type="text/css" />

<title><?php echo $config_sitename; ?></title>
	
<!--Analytics -->	
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30960598-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>	
</head>

<body>

<!-- header starts here -->
	<div id="header-wrap"><div id="header-content">	
		
		<h1 id="logo"><a href="index.php" title="">Peter<span class="orange">Watters</span></a></h1>	
					
		<div id="header-links">
			<p>
				<a href="<?php echo $config_basedir; ?>index.php">Home</a> | 
				<a href="<?php echo $config_basedir; ?>contact.php">Contact</a> | 
							
			</p>		
		</div>
		
		
		<!-- Menu Tabs -->
		<ul>	
			<li><a href="<?php echo $config_basedir; ?>index.php">Home</a></li>
			<li><a href="<?php echo $config_basedir; ?>portfolio.php">Portfolio</a></li>
			<li><a href="<?php echo $config_basedir; ?>projects.php">Projects</a></li>
			<li><a href="<?php echo $config_basedir; ?>contact.php">Contact</a></li>	
		</ul>	
					
	

	</div>

</div>