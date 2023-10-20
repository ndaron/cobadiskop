<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<?php
			beritaxx_head_meta();
			wp_head();
		?>

	</head>
	
	<body <?php body_class(); ?> id="<?php echo esc_html( get_theme_mod('header_switch', "default") ); ?>">
	    <?php wp_body_open(); ?>
	    <div class="taxxnews taxx_clear">
			<!-- Header -->
		    <section class="header">
			    <?php taxx_header_switch(); ?>
			</section>
			
			<div class="left_ads taxx_float_ads"><?php taxx_floating_left(); ?></div>