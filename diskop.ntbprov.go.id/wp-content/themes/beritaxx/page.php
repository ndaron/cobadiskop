<?php get_header(); ?>
    
	<div class="header_ads"><?php taxx_header_ads(); ?></div>
	
	<div class="nav_breadcrumb">
	    <div class="breadcrumb_inner">
	        <?php theme_nav_breadcrumb(); ?>
        </div>
    </div>
	
	<?php
        if (have_posts()):
	    	while (have_posts()): the_post(); 
			?>
			
			<div class="area_content">
		    	<div class="area_content_outer taxx_clear">
				    
					<!-- Left Content -->
					<div class="area_primary">
					    <div class="primary_content">
						    
							<div class="area_title">
							    <h1 class="taxx_the_title"><?php the_title(); ?></h1>
							</div>
							
							<?php settViews(get_the_ID()); ?>
							
							<div class="primary_big">
				                
					    		<div class="primary_featured">
							    	<?php 
									    // Featured Image
								    	if (has_post_thumbnail()) {
											the_post_thumbnail('full');
										}
									?>
							    </div>
							
						    	<div class="beritaxx_article taxx_clear">
							        <?php the_content(); ?>
						    	</div>
								
						    	<?php
						        	if (comments_open()): 
							    	?>
									<div class="beritaxx_commentform taxx_clear">
										<div class="have_comment">
										    <h4 class="comment_heads">
										        <?php echo esc_html( comments_number() ); ?>
									        </h4>
											<?php
											comment_form();
											?>
										</div>
									</div>
									<div class="beritaxx_listcomment taxx_clear">
										<ul class="commentlist">
									    	<?php
										    	$comments = get_comments(array(
											    	'post_id' => get_the_id(),
													'status' => 'approve',
												));
												wp_list_comments( array(
													'reverse_top_level' => false,
													'callback' => 'commentslist',
												), $comments );
											?>
										</ul>
							    	</div>
							    	<?php
							    	endif;
						    	?>
							</div>
							
						</div>
					</div>
					
                    <?php get_sidebar(); ?>
					
				</div>
				
			</div>
		
		<?php 
		endwhile; 
	    endif; 
	?>
	
<?php get_footer(); ?>