<?php if (wp_loaded() === true) { ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<!--[if lte IE 7]>
<link href="<?php bloginfo('template_url'); ?>/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if lte IE 6]>
<link href="<?php bloginfo('template_url'); ?>/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if lte IE 6]>
<style type="text/css">
#ie6msg{border:3px solid #090; margin:8px 0; background:#cfc; color:#000;}
#ie6msg h4{margin:8px; padding:0;}
#ie6msg p{margin:8px; padding:0;}
#ie6msg p a.getie8{font-weight:bold; color:#006;}
#ie6msg p a.ie6expl{font-weight:normal; color:#006;}
</style>
<div id="ie6msg">
<h4>Did you know that your browser is out of date?</h4>
<p>To get the best possible experience using our website we recommend that you upgrade your browser to a newer version. The current version is <a class="getie8" href="http://upgradeie.s3.amazonaws.com/eng/index.html">Internet Explorer 8</a>. The upgrade is free. If you're using a PC at work you should contact your IT administrator.</p>
<p>If you want to you may also try some other popular Internet browsers like <a class="ie6expl" href="http://getfirefox.com">Firefox</a>, <a class="ie6expl" href="http://www.opera.com">Opera</a>, or <a class="ie6expl" href="http://www.apple.com/safari/download/">Safari</a></p>
</div>
<![endif]-->

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php  wp_head(); ?>

</head><?php } ?>

<body>

<div id="page">

<div id="header">

<?php include(TEMPLATEPATH."/menu.php");?>

<?php include(TEMPLATEPATH."/parallax.php");?>

</div>

<script>
   jQuery.noConflict();
</script>

<div id="pbody">

<hr />
