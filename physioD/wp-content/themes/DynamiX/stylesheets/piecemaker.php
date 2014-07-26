<?php header("Content-type: text/css; charset: UTF-8"); 

require_once( '../../../../wp-load.php' );

if($_SESSION['piecemaker_ID']) $page_id = $_SESSION['piecemaker_ID'];

$data = maybe_unserialize(get_post_meta($page_id, 'pgopts', true )); // Call custom page attributes  

$DYN_3dincolor 	= ($data["gallery3dincolor"]	!="") ? $data["gallery3dincolor"]	: 'FFFFFF';
$DYN_linkcolor 	= (LINKCOLOR	!="") ? LINKCOLOR	: '1594d9';
$DYN_linkhover 	= (LINKHOVER	!="") ? LINKHOVER	: '3bb8ff';
?>


H1 {
	font-family: Verdana;
	font-style: bold;
	font-weight: normal;
	color: #<?php echo $DYN_3dincolor; ?>;
	display: block;
	font-size: 20px;
	margin-bottom: 10px;
	line-height: 30;
	text-align: left;
	letter-spacing: 0px;
}

P {
	font-family: Verdana;
	font-style: normal;
	font-weight: normal;
	color: #<?php echo $DYN_3dincolor; ?>;
	display: block;
	font-size: 12px;
	margin-bottom: 10px;
	line-height: 18px;
	text-align: left;
	letter-spacing: 0.2px;
}

P-ITALIC {
	font-family: Verdana;
	font-style: italic;
	font-weight: normal;
	color: #<?php echo $DYN_3dincolor; ?>;
	display: block;
	font-size: 12px;
	margin-bottom: 10px;
	line-height: 18px;
	text-align: left;
	letter-spacing: 0.5px;
}


A {
	color: #<?php echo $DYN_linkcolor; ?>;
	display: inline;
}

A:HOVER {
	color: #<?php echo $DYN_linkhover; ?>;
	display: inline;
}
