<?php get_header(); ?>

    <div class="header_ads"><?php taxx_header_ads(); ?></div>
	
    <div class="nav_breadcrumb">
	    <div class="breadcrumb_inner">
	        <?php theme_nav_breadcrumb(); ?>
        </div>
    </div>
	
	<div class="share_archive"><?php get_template_part('content/share-archive'); ?></div>

	<div class="area_content">
		<div class="area_content_outer taxx_clear">
		    <?php 
			   echo '<h1 class="archive_head">';
			   if ( is_category() ) {
				   echo single_cat_title('', false);
			   } else if ( is_tag() ) {
				   echo sprintf( __( 'Tag : %s', 'beritaxx' ), single_tag_title('', false) );
			   } else if ( is_author() ) {
				   echo sprintf( __( 'Author : %s', 'beritaxx' ), esc_html( $userdata->display_name ) );
			   } else if ( is_day() ) {
				   echo esc_html( get_the_time('d F Y') );
			   } else if ( is_month() ) {
				   echo esc_html( get_the_time('F Y') );
			   } else if ( is_year() ) {
				   echo esc_html( get_the_time('Y') );
			   }
			   echo '</h1>';
			?>
			<?php get_template_part('content/loop-post'); ?>
			<?php get_template_part('content/pagination'); ?>
		</div>
	</div>

<?php get_footer(); ?>