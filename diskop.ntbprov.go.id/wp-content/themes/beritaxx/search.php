<?php get_header(); ?>

    <div class="header_ads"><?php taxx_header_ads(); ?></div>
	
	<div class="nav_breadcrumb">
	    <div class="breadcrumb_inner">
	        <?php theme_nav_breadcrumb(); ?>
        </div>
    </div> 
	
	<div class="area_content">
		<div class="area_content_outer taxx_clear">
		    <h1 class="archive_head">
				<?php 
					echo esc_html_e('Search : ', 'beritaxx');
					the_search_query();
				?>
			</h1>
			<?php get_template_part('content/loop-post'); ?>
			<?php get_template_part('content/pagination'); ?>
		</div>
	</div>

<?php get_footer(); ?>