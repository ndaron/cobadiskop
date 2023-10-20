<?php
class FullBlock1 extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'full_block_one',
			'description'                 => __( 'Combination from Featured Slide, Latest Post Slide, and Trending Post.', 'beritaxx' ),
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct( 'fullblock1', __( 'Full Block 1', 'beritaxx' ), $widget_ops );
            
	}
	
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		$title_featured         = ( ! empty( $instance['title_featured'] ) ) ? $instance['title_featured'] : __( 'Featured', 'beritaxx' );
		$title_latest           = ( ! empty( $instance['title_latest'] ) ) ? $instance['title_latest'] : __( 'Latest', 'beritaxx' );
		$title_trending         = ( ! empty( $instance['title_trending'] ) ) ? $instance['title_trending'] : __( 'Trending', 'beritaxx' );
		$trend_duration         = ( ! empty( $instance['trend_duration'] ) ) ? $instance['trend_duration'] : '-30 days';
		if ( ! $trend_duration ) {
			$trend_duration = '-30 day';
		}
	
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title_featured = apply_filters( 'widget_title', $title_featured, $instance, $this->id_base );
		
		echo $args['before_widget'];
		?>
		    
		    <div class="full_block_content beritaxx_widget<?php echo $args['widget_id']; ?>">
		    	<div class="full_block_outer taxx_clear">
				    
					<!-- FEATURED -->
			    	<div class="full_block_left">
				    	<div class="full_block_inner">
						    <?php
							    $berita_args = array( 
							    	'post_type' => 'post', 
									'numberposts' => 5,
								); 
								global $post;
								$get_berita = get_posts($berita_args);
								?>
								
								<h4 class="post_feat_head"><?php if ( $title_featured ) { echo $title_featured; } ?></h4>
							   	<div class="full_block_slide feat_slide<?php echo $args['widget_id']; ?> owl-carousel owl-theme">
							    	<?php
								    	foreach ($get_berita as $post):
										setup_postdata($post); 
										?>
								        	<div class="item">
									        	<?php
										        	if (has_post_thumbnail()) { 
											        	the_post_thumbnail('slide', array(
												        	'alt' => trim(strip_tags($post->post_title)),
													    	'title' => trim(strip_tags($post->post_title)),
												    	)); 
											    	}
										    	?>
										    	<div class="post_feat">
										        	<div class="feat_over">
											        	<div class="taxx_time"><?php echo the_time(); ?></div>
												    	<div class="feat_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
											    	</div>
									    		</div>
									    	</div>
								    	<?php
										endforeach;
									?>
								</div>
								
								<script>
							    	jQuery(document).ready(function() {
										jQuery('.feat_slide<?php echo $args['widget_id']; ?>').owlCarousel({
											margin: 20,
											loop: true,
											nav: false,
											dots: true,
											lazyLoad: true,
											autoplay: true,
											animateIn: 'fadeIn',
											animateOut: 'fadeOut',
											smartSpeed: 1000,
											autoplayTimeout: 4000,
											autoplayHoverPause: false,
											items: 1,
										})
									});
								</script>
								
							<?php 
						    	$late_args = array(
							    	'post_type' => 'post',
									'numberposts' => 3,
								); 
								global $post;
								$get_late = get_posts($late_args);
								
								?>
								
								<div class="latest_three">
								    <span class="fbo_latest"><?php if ( $title_latest ) { echo $title_latest; } ?></span>
								    <div class="three_slide<?php echo $args['widget_id']; ?> owl-carousel owl-theme">
						            
									<?php 
								    	foreach ($get_late as $post):
										setup_postdata($post); 
										?>
								        	<div class="item">
									        	<div class="latest_three_img"><?php
										        	if (has_post_thumbnail()) { 
											        	the_post_thumbnail('berita', array(
												        	'alt' => trim(strip_tags($post->post_title)),
													    	'title' => trim(strip_tags($post->post_title)),
												    	)); 
											    	}
										    	?></div>
										    	<div class="">
										        	<div class="latest_over">
											        	<div class="time_mini"><?php echo the_time(); ?></div>
												    	<div class="latest_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
														<div class="latest_after"><span class="com_mini"><i class="far fa-eye"></i> <?php echo getViews(get_the_ID()); ?></span> <span class="user_mini"><i class="far fa-user-circle"></i> <?php the_author(); ?></span></div>
											    	</div>
										    	</div>
									    	</div>
										<?php
										endforeach;
									?>
									
									</div>
								</div>
								
								<script>
        						    jQuery(document).ready(function() {
										jQuery('.three_slide<?php echo $args['widget_id']; ?>').owlCarousel({
											margin: 12,
											loop: true,
											nav: false,
											dots: false,
											lazyLoad: true,
											autoplay: true,
											animateIn: 'fadeIn',
											animateOut: 'fadeOut',
											smartSpeed: 1000,
											autoplayTimeout: 4000,
											autoplayHoverPause: false,
											responsive:{
												0:{ 
											    	items:2
												},
												520:{
												    items:2
												},
												640:{
												    items:1
												},
												768:{
												    items:2
												},
												1025:{
													items:3
												}
											} 
										})
        						    });
        					    </script>
								
						</div>
					</div>
					
					<!-- TRENDING -->
					<div class="popular_right">
		    		    <div class="popular_inner">
					    	<?php 
						    	$today = getdate();
						    	$pop_args = array( 
							    	'post_type' => 'post', 
									'numberposts' => 5,
									'meta_key'          => 'post_views_count',
									'orderby'           => 'meta_value_num',
									'ignore_sticky_posts' => 1,
									'post_status'       => 'publish',
									'date_query'        => array(
								    	'after'   => $trend_duration,
									)
								); 
								global $post;
								$get_late = get_posts($pop_args);
								?>
								
								<div class="taxx_clear">
							    	<h3 class="popular_head"><?php if ( $title_trending ) { echo $title_trending; } ?></h3>
									<?php 
								    	foreach ($get_late as $post):
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
		$instance                       = $old_instance;
		$instance['title_featured']     = sanitize_text_field( $new_instance['title_featured'] );
		$instance['title_latest']       = sanitize_text_field( $new_instance['title_latest'] );
		$instance['title_trending']     = sanitize_text_field( $new_instance['title_trending'] );
		$instance['trend_duration']     = sanitize_text_field( $new_instance['trend_duration'] );
		
		return $instance;
	}

	public function form( $instance ) {
		$title_featured   = isset( $instance['title_featured'] ) ? esc_attr( $instance['title_featured'] ) : __( 'Featured', 'beritaxx' );
		$title_latest     = isset( $instance['title_latest'] ) ? esc_attr( $instance['title_latest'] ) : __( 'Latest', 'beritaxx' );
		$title_trending   = isset( $instance['title_trending'] ) ? esc_attr( $instance['title_trending'] ) : __( 'Trending', 'beritaxx' );
		$trend_duration   = isset( $instance['trend_duration'] ) ? esc_attr( $instance['trend_duration'] ) : '-30 days';
		
		?>
		<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/widgets/silhouette/widget-full-one.png" />
		<p>
			<label for="<?php echo $this->get_field_id( 'title_featured' ); ?>"><?php echo __( 'Featured Block Title :', 'beritaxx' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title_featured' ); ?>" name="<?php echo $this->get_field_name( 'title_featured' ); ?>" type="text" value="<?php echo $title_featured; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title_latest' ); ?>"><?php echo __( 'Latest Block Title :', 'beritaxx' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title_latest' ); ?>" name="<?php echo $this->get_field_name( 'title_latest' ); ?>" type="text" value="<?php echo $title_latest; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title_trending' ); ?>"><?php echo __( 'Trending Block Title :', 'beritaxx' ); ?></label>
			<input class="widefat berita_pad10" id="<?php echo $this->get_field_id( 'title_trending' ); ?>" name="<?php echo $this->get_field_name( 'title_trending' ); ?>" type="text" value="<?php echo $title_trending; ?>" />
		    <select class="widefat" id="<?php echo $this->get_field_name( 'trend_duration' ); ?>" name="<?php echo $this->get_field_name( 'trend_duration' ); ?>">
			    <option <?php selected( $instance['trend_duration'], '-1 days'); ?> value="-1 days"><?php echo __( 'Daily', 'beritaxx' ); ?></option>
				<option <?php selected( $instance['trend_duration'], '-7 days'); ?> value="-7 days"><?php echo __( 'Weekly', 'beritaxx' ); ?></option>
				<?php 
			    	if ( ! $trend_duration ) {
					?>
			        	<option <?php selected( $instance['trend_duration'], '-30 days'); ?> value="-30 days"><?php echo __( 'Monthly', 'beritaxx' ); ?></option>
					<?php 
					} else {
					?>
					    <option selected value="-30 days"><?php echo __( 'Monthly', 'beritaxx' ); ?></option>
					<?php
					}
				?>
					
			</select>
		</p>
		<span class="widget_lite_title"><?php echo __( 'Beritaxx Widget', 'beritaxx' ); ?></span>
		
		<?php
	}
}