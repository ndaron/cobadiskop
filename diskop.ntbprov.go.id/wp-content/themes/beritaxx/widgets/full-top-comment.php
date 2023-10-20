<?php
class FullTopComment extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'full_top_comment',
			'description'                 => __( 'Show post with most comments.', 'beritaxx' ),
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct( 'fulltopcomment', __( 'Top Comment (Full)', 'beritaxx' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title         = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Most Commented', 'beritaxx' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		
		echo $args['before_widget'];
		?>
		
		    <div class="full_block_content">
		    	<div class="top_comment_outer taxx_clear">
				    
					<!-- TOP COMMENTED -->
					<div class="top_comment">
		    		    <div class="comment_inner">
						    <?php
							    $breaks = 0;
								$pop_args = array( 
							    	'post_type' => 'post', 
									'numberposts' => 5,
									'orderby' => 'comment_count',
								); 
								global $post;
								$get_late = get_posts($pop_args);
								?>
								
								<div class="taxx_clear">
									<?php 
								    	foreach ($get_late as $post):
										setup_postdata($post); 
										$breaks++;
										?>
										
										    <div class="comment_ten comment<?php echo $breaks; ?>">
										    	<div class="comment_post_inner">
											    	<a href="<?php the_permalink(); ?>">
													    <div class="comment_img">
													      	<?php 
														    	if (has_post_thumbnail()) {
																	the_post_thumbnail('berita', array(
																    	'alt' => trim(strip_tags($post->post_title)),
																		'title' => trim(strip_tags($post->post_title)),
																	));
																}
															?>
														</div>
													</a>
													<div class="comment_counter"><?php echo esc_html( comments_number( '0', '1', '%' ) ); ?></div>
													<div class="comment_over">
												    	<div class="comment_time_mini"><?php the_time(); ?></div>
														<div class="comment_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
														<div class="list_after"><span class="com_mini"><i class="far fa-eye"></i> <?php echo getViews(get_the_ID()); ?></span> <span class="user_mini"><i class="far fa-user-circle"></i> <?php the_author(); ?></span></div>
													</div>
												</div>
											</div>
										    <div class="taxx_clear comment_clear comment<?php echo $breaks; ?>_clear"></div>
											
										<?php
										endforeach; 
									?>
								</div>
							
						</div>
					</div>
					<!-- TOP COMMENTED -->
					
				</div>
			</div>
			
		<?php
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['number']    = (int) $new_instance['number'];
		return $instance;
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __( 'Most Commented', 'beritaxx' );
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		?>
		<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/widgets/silhouette/topcomment-full.png" />
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Block Title', 'beritaxx' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php echo __( 'Number of posts to show :', 'beritaxx' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>
		<?php
	}
}