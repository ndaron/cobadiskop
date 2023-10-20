<?php
	
	$breaks = 0;
	if ( have_posts() ) { 
		echo '<div class="latest_news taxx_clear">';
	    while ( have_posts() ): the_post();
		$breaks++;
		?>     
			<div class="latest_ten latest<?php echo $breaks; ?>">
			    <div class="latest_post_inner">
				    <a href="<?php the_permalink(); ?>">
					    <div class="latest_img">
					    <?php 
					    if (has_post_thumbnail()) { 
						    the_post_thumbnail('berita', array(
						    	'alt' => trim(strip_tags($post->post_title)),
						    	'title' => trim(strip_tags($post->post_title)),
					    	)); 
					    } ?>
						</div>
					</a>
				    <div class="latest_over">
					    <div class="latest_time_mini"><?php the_time(); ?></div>
						<div class="latest_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
						<div class="list_after"><span class="com_mini"><i class="far fa-eye"></i> <?php echo getViews(get_the_ID()); ?></span> <span class="user_mini"><i class="far fa-user-circle"></i> <?php the_author(); ?></span></div>
					</div>
				</div>
			</div>
			<div class="taxx_clear latest_clear latest<?php echo $breaks; ?>_clear"></div>
		<?php
		endwhile; 
		echo '</div>';
	}