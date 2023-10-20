<?php
	
	$breaks = 0;
	if ( have_posts() ) { 
		echo '<div class="block_outer taxx_clear">';
	    while ( have_posts() ): the_post();
		$breaks++;
		?>     
			<div class="loop_block">
			    <div class="loop_block_inner">
				    <div class="block_img">
					    <a href="<?php the_permalink(); ?>">
					    <?php 
					    if (has_post_thumbnail()) { 
						    the_post_thumbnail('berita', array(
						    	'alt' => trim(strip_tags($post->post_title)),
						    	'title' => trim(strip_tags($post->post_title)),
					    	)); 
					    } ?>
						</a>
					</div>
				    <div class="block_over">
					    <div class="block_time_mini"><?php the_time(); ?></div>
						<div class="block_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
						<div class="block_after"><span class="com_mini"><i class="far fa-eye"></i> <?php echo getViews(get_the_ID()); ?></span> <span class="user_mini"><i class="far fa-user-circle"></i> <?php the_author(); ?></span></div>
					</div>
				</div>
			</div>
			<div class="taxx_clear block<?php echo $breaks; ?>">
			</div>
		<?php
		endwhile; 
		echo '</div>';
	}
	