<?php
/**
* Template Name: Full Width Page
*
* @package WordPress
* @subpackage beritaxx lite
* @since Beritaxx 1.0
*/

get_header();

        if (have_posts()):
	    	while (have_posts()): the_post(); 
			?>
			
			<div class="area_content">
		    	<div class="area_content_outer taxx_clear">
				    
					<!-- Full Content -->
					<div class="area_primary area_full">
						<div class="beritaxx_article taxx_clear">
							<?php the_content(); ?>
						</div>	
					</div>
					
				</div>
				
			</div>
		
		    <?php 
	    	endwhile; 
	    endif; 
		
get_footer();