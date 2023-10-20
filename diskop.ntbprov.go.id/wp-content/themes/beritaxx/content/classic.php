<div class="taxx_clear">

<!-- Left Content -->
<div class="area_primary">
	<div class="primary_content">

    <?php
	
	$breaks = 0;
	if ( have_posts() ) { 
		echo '<div class="latest_news taxx_clear">';
	    while ( have_posts() ): the_post();
		$breaks++;
		?>     
			<div class="loop_classic taxx_clear classic<?php echo $breaks; ?>">
				    <div class="classic_img">
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
				    <div class="classic_over">
					    <div class="classic_time_mini"><?php the_time(); ?></div>
						<div class="classic_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
						<div class="classic_after"><span class="com_mini"><i class="far fa-eye"></i> <?php echo getViews(get_the_ID()); ?></span> <span class="user_mini"><i class="far fa-user-circle"></i> <?php the_author(); ?></span></div>
					</div>
			</div>
		<?php
		endwhile; 
		echo '</div>';
	}
	?>
	
	</div>
</div>

<?php get_sidebar(); ?>

</div>