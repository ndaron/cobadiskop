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
			global $post;
			$taxx_embed = get_post_meta($post->ID, 'taxx_embed', true);
			?>
			
			<div class="area_content">
		    	<div class="area_content_outer taxx_clear">
				    
					<!-- Left Content -->
					<div class="area_primary">
					    <div class="primary_content">
						    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="area_title">
							    <h1 class="taxx_the_title"><?php the_title(); ?></h1>
								<div class="time_view"><span><?php echo sprintf( __( '%s reading', 'beritaxx' ), reading_time() ); ?></span> <?php get_template_part('content/share-post'); ?></div>
								<div class="after_title">
								    <?php echo esc_html(get_the_date('l, j M Y H:i') ); ?>
						        	<span><i class="far fa-comment-dots"></i> <?php echo esc_html( comments_number( '0', '1', '%' ) ); ?> <i class="far fa-eye"></i> <?php echo getViews(get_the_ID()); ?> <i class="far fa-user-circle"></i> <?php the_author(); ?></span>
						    	</div>
							</div>
							
							<?php settViews(get_the_ID()); ?>
							
							<div class="primary_big">
				                
					    		<div class="primary_featured">
							    	<?php 
									    if ($taxx_embed == !'') {
											// Show Video
											echo wp_oembed_get( $taxx_embed );
										} else {
											// Show Featured Image
											if (has_post_thumbnail()) {
												the_post_thumbnail('full');
												if (get_the_post_thumbnail_caption()) {
												echo '<span>';
											    	the_post_thumbnail_caption();
									        	echo '</span>';
												}
											}
										}
									?>
							    </div>
							
						    	<div class="beritaxx_article taxx_clear">
							        <?php the_content(); ?>
						    	</div>
								
								<div class="beritaxx_tags taxx_clear">
							    	<?php the_tags('',''); ?>
						    	</div>
								
								<div class="beritaxx_bio taxx_clear">
								    <?php 
									    if ( empty( $display_name ) ) {
											$display_name     = get_the_author_meta( 'display_name', $post->post_author );
										} else {
											$display_name     = get_the_author_meta( 'nickname', $post->post_author );
										}
									    $user_description = get_the_author_meta( 'user_description', $post->post_author );
										$user_website     = get_the_author_meta('url', $post->post_author);
										$user_posts       = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
									?>
								    <div class="bio_avatar">
									    <?php
										    echo get_avatar( get_the_author_meta('user_email') , 90 );
										?>
									</div>
									<div class="bio_author">
								    <p class="bio_name"><?php echo $display_name; ?> <i class="fas fa-check-circle"></i></p>
									<p class="bio_data"><?php echo nl2br( $user_description ); ?></p>
									<p class="bio_links"><a href="<?php echo $user_posts; ?>"><?php echo __( 'Another post by', 'beritaxx' ); ?> <?php echo $display_name; ?></a></p>
									<p class="bio_social">
									    <?php
										    if ( get_the_author_meta( 'ufacebook' ) != "" ) {
									    		echo '<a target="_blank" href="'. get_the_author_meta( 'ufacebook' ) .'"><i class="fab fa-facebook"></i></a>';
									    	}
									    	if ( get_the_author_meta( 'utwitter' ) != "" ) {
									    		echo '<a target="_blank" href="'. get_the_author_meta( 'utwitter' ) .'"><i class="fab fa-twitter"></i></a>';
									    	}
									    	if ( get_the_author_meta( 'uinstagram' != "" ) ) {
									    		echo '<a target="_blank" href="'. get_the_author_meta( 'uinstagram' ) .'"><i class="fab fa-instagram"></i></a>';
									    	}
									    	if ( get_the_author_meta( 'uyoutube' ) != "" ) {
									    		echo '<a target="_blank" href="'. get_the_author_meta( 'uyoutube' ) .'"><i class="fab fa-youtube"></i></a>';
									    	}
											if ( get_the_author_meta( 'uwhatsapp' ) != "" ) {
									    		$input_wa = get_the_author_meta( 'uwhatsapp' ); 
									    		$real_wa = preg_replace("/[^A-Za-z0-9?!]/",'',$input_wa);
									    		echo '<a target="_blank" class="wa_mobile" href="https://api.whatsapp.com/send?phone=' . $real_wa . '"><i class="fab fa-whatsapp"></i></a><a target="_blank" class="wa_desktop" href="https://web.whatsapp.com/send?phone=' . $real_wa . '"><i class="fab fa-whatsapp"></i></a>';
									    	}
									    	
										?>
									</p>
									</div>
								</div>
								
								<div class="beritaxx_related taxx_clear">
						        	<?php post_related_by_category(); ?>
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
					</div>
					
                    <?php get_sidebar(); ?>
					
				</div>
				
			</div>
		
		<?php 
		endwhile; 
	    endif; 
	?>
	
<?php get_footer(); ?>