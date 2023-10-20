<!DOCTYPE html>
<!--[if IE 7]><html class="ie7 no-js"  <?php language_attributes(); ?><![endif]-->
<!--[if lte IE 8]><html class="ie8 no-js"  <?php language_attributes(); ?><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie no-js" <?php language_attributes(); ?>>  <!--<![endif]-->
<head>
<meta charset="utf-8">
<title> <?php if ( is_home() ) { ?><?php bloginfo('name'); ?> - <?php bloginfo('description'); } else{ ?><?php  wp_title(''); ?> - <?php bloginfo('name'); } ?></title>
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:800' rel='stylesheet' type='text/css'>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="Shortcut Icon" href="<?php $ico = of_get_option('favicon'); ?><?php echo $ico; ?>" type="image/x-icon" />
<?php $fbappid = of_get_option('fbappid'); if(($fbappid == '')) { ?>
<?php } else { ?>
<meta property='fb:app_id' content='<?php echo of_get_option('fbappid'); ?>' />
<?php } ?>
<?php wp_head(); ?>
<style type="text/css">
<?php $ctheme = of_get_option('ctheme');
	$ltheme = of_get_option('ltheme');
    echo '#main-menu { border-bottom-color:'.$ctheme.'; }';
    echo '.widget-title span, .breadcrumbs span, #sidebar h3.title span { border-left-color:'.$ctheme.'; }';
    echo 'a:link, a:visited, a:hover, a:focus { color:'.$ltheme.'; }';
    echo '.post h2 a:hover, #sidebar a:hover, .post .link a, .related_posts h4 a:hover, #main-menu .main-menu li a:hover { color:'.$ltheme.'; }';
    echo '#main-menu .main-menu li li a, #main-menu .main-menu li li a:link, #main-menu .main-menu li li a:visited { background:'.$ltheme.'; border-bottom-color:'.$ctheme.'; }';

	$background = of_get_option('background');
	if ($background) {
		if ($background['image']) {
		echo 'body {background:url('.$background['image'].') '.' '. $background['color'] .' '. $background['repeat'] .' '. $background['position'] .' '. $background['attachment'] .';}';
		}else{
		echo 'body {background-color:'.$background['color'].'}';
		}
	};
?>
</style>
</head>
<body>
<div id="wrap">
<header id="header">
	<div class="logo">
	<a href="<?php echo home_url() ; ?>"><img src="<?php echo of_get_option('logo'); ?>" /></a>
	</div>
</header>
<nav id="main-menu">
	<div class="ihome"><a href="<?php bloginfo('url'); ?>" title="Home"><img src="<?php bloginfo('template_url'); ?>/img/home.gif"></a></div>
	<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'main-menu' , 'fallback_cb' => '' ) ); ?>




</nav>