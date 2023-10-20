<?php
class LatestSidebar extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'latest_sidebar',
			'description'                 => __( 'Show latest post on Sidebar', 'beritaxx' ),
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct( 'latestsidebar', __( 'Latest Post (Sidebar)', 'beritaxx' ), $widget_ops );
            
	}
	
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		$title_latest         = ( ! empty( $instance['title_latest'] ) ) ? $instance['title_latest'] : __( 'Latest Post', 'beritaxx' );
		
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title_latest = apply_filters( 'widget_title', $title_latest, $instance, $this->id_base );
		
		$latest_count = ( ! empty( $instance['latest_count'] ) ) ? absint( $instance['latest_count'] ) : 3;
		if ( ! $latest_count ) {
			$latest_count = 8;
		}
		
		echo $args['before_widget'];
		?>
		    
		    <div class="latest_post_sidebar beritaxx_widget<?php echo $args['widget_id']; ?>">
		    	<div class="latest_post_outer taxx_clear">
				    
					<!-- LATEST -->
					<div class="latest_sidebar_block">
		    		    <div class="latest_sidebar_inner">
					    	<?php 
						    	$late_args = array( 
							    	'post_type' => 'post', 
									'numberposts' => $latest_count,
									'ignore_sticky_posts' => 1,
									'post_status'       => 'publish',
								); 
								global $post;
								$get_latesidebar = get_posts($late_args);
								?>
								
								<div class="taxx_clear">
							    	<h3 class="popular_head"><?php if ( $title_latest ) { echo $title_latest; } ?></h3>
									<?php 
								    	foreach ($get_latesidebar as $post):
										setup_postdata($post); 
										?>
								        	<div class="popular_list taxx_clear">
										    	<div class="popular_list_img">
										        	<?php 
											        	if (has_post_thumbnail()) {
													    	the_post_thumbnail('small', array(
													        	'alt' => trim(strip_tags($post->post_title)),
													    		'title' => trim(strip_tags($post->post_title)),
													    	));
												    	}
											    	?>
										    	</div>
												<div class="popular_list_post">
											    	<div class="popular_list_over">
												    	<div class="time_mini"><?php the_time(); ?></div>
														<div class="popular_list_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
														<div class="popular_list_after"><span class="com_mini"><i class="far fa-eye"></i> <?php echo getViews(get_the_ID()); ?></span> <span class="user_mini"><i class="far fa-user-circle"></i> <?php the_author(); ?></span></div>
													</div>
												</div>
											</div>
										<?php
										endforeach; 
									?>
								</div>
						</div>
					</div>
					
				</div>
			</div>
			
	    	<?php
	    
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance                 = $old_instance;
		$instance['title_latest'] = sanitize_text_field( $new_instance['title_latest'] );
		$instance['latest_count'] = sanitize_text_field( $new_instance['latest_count'] );
		return $instance;
	}

	public function form( $instance ) {
		$title_latest   = isset( $instance['title_latest'] ) ? esc_attr( $instance['title_latest'] ) : __( 'Latest Post', 'beritaxx' );
		$latest_count      = isset( $instance['latest_count'] ) ? esc_attr( $instance['latest_count'] ) : 8;
		?>
		<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/widgets/silhouette/latest-sidebar.png" />
		<p>
			<label for="<?php echo $this->get_field_id( 'title_latest' ); ?>"><?php echo __( 'Block Title', 'beritaxx' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title_latest' ); ?>" name="<?php echo $this->get_field_name( 'title_latest' ); ?>" type="text" value="<?php echo $title_latest; ?>" />
		</p>
		<p>
	    	<label for="<?php echo $this->get_field_id( 'latest_count' ); ?>"><?php echo __( 'Number of posts to show :', 'beritaxx' ); ?></label>
	    	<input class="widefat" id="<?php echo $this->get_field_id( 'latest_count' ); ?>" name="<?php echo $this->get_field_name( 'latest_count' ); ?>" type="number" value="<?php echo esc_attr( $latest_count ); ?>" />
		</p>
		<span class="widget_lite_title"><?php echo __( 'Beritaxx Widget', 'beritaxx' ); ?></span>
		
		<?php
	}
}