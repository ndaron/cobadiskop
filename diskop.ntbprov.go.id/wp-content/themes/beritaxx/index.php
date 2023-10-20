<?php get_header(); ?>

<div class="header_ads"><?php taxx_header_ads(); ?></div>

<?php
	if ( is_front_page() && !is_paged() ) {
		echo '<div class="home-widget">';
		    if ( is_active_sidebar( 'widget-home' ) ) { 
			    dynamic_sidebar( 'widget-home' );
			}
		echo '</div>';
	} else {
		echo '<!-- Bukan Halaman Depan -->';
	}
?>
	
	<div class="area_content">
		<div class="area_content_outer taxx_clear">
			<?php get_template_part('content/loop-post'); ?>
			<?php get_template_part('content/pagination'); ?>
		</div>
	</div>

<?php get_footer(); ?>