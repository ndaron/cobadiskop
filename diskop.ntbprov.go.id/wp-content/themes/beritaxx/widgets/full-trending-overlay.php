<?php
class FullTrendingOverlay extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'trending_overlay',
			'description'                 => __( 'Show trending post', 'kabar' ),
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct( 'trendingoverlay', __( 'Trending Post Overlay (Full)', 'beritaxx' ), $widget_ops );
            
	}
	
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		$title_latest         = ( ! empty( $instance['title_latest'] ) ) ? $instance['title_latest'] : __( 'Trending Post', 'beritaxx' );
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title_latest = apply_filters( 'widget_title', $title_latest, $instance, $this->id_base );
		$fto_count = ( ! empty( $instance['fto_count'] ) ) ? absint( $instance['fto_count'] ) : 5;
		$trend_duration         = ( ! empty( $instance['trend_duration'] ) ) ? $instance['trend_duration'] : '-30 days';
		if ( ! $trend_duration ) {
			$trend_duration = '-30 day';
		}
		if ( ! $fto_count ) {
			$fto_count = 6;
		}
		$float_dir         = ( ! empty( $instance['float_dir'] ) ) ? $instance['float_dir'] : 'right_dir';
		if ( ! $float_dir ) {
			$float_dir = 'right_dir';
		}
		echo $args['before_widget'];
		?>
		    
		    <div class="fto">
		    	<div class="fto_outer">
					<div class="fto_block taxx_clear">
					    <?php 
						    $today = getdate();
						    $fto_arg = array( 
							    'post_type' => 'post', 
								'numberposts' => $fto_count,
								'ignore_sticky_posts' => 1,
								'post_status'       => 'publish',
								'meta_key'          => 'post_views_count',
								'orderby'           => 'meta_value_num',
								'ignore_sticky_posts' => 1,
								'date_query'        => array(
									'after'   => $trend_duration,
								)
							); 
							global $post;
							$get_fto = get_posts($fto_arg);
							?>
								
								<h3 class="fto_head"><?php if ( $title_latest ) { echo $title_latest; } ?></h3>
								<?php 
									$ctrend = 0;
								    foreach ($get_fto as $post):
								    setup_postdata($post); 
									$ctrend++;
									if ( $ctrend < 10 ) {
										$num = '0'.$ctrend;
									} else {
										$num = $ctrend;
									}
									?>
									<div class="<?php echo $float_dir; ?> fto_widget">
										<div class="fto_inner">
										    <?php 
												if (has_post_thumbnail()) {
													the_post_thumbnail('berita', array(
												    	'alt' => trim(strip_tags($post->post_title)),
														'title' => trim(strip_tags($post->post_title)),
													));
												}
											?>
								        	<div class="taxx_clear">
										    	<div class="fto_number">
										        	<span><?php echo $num; ?></span>
										    	</div>
												<div class="fto_post">
											    	<div class="fto">
														<div class="fto_time"><span><?php the_time(); ?></span></div>
						                                <div class="fto_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
													</div>
												</div>
											</div>
										</div>
										<div  class="bar_<?php echo $ctrend; ?> class_clear"></div>
									</div>
									<?php
									endforeach; 
								?>
					
					</div>
				</div>
			</div>
			
	    	<?php
	    
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance                 = $old_instance;
		$instance['title_latest'] = sanitize_text_field( $new_instance['title_latest'] );
		$instance['fto_count'] = sanitize_text_field( $new_instance['fto_count'] );
		$instance['float_dir']  = sanitize_text_field( $new_instance['float_dir'] );
		$instance['trend_duration']     = sanitize_text_field( $new_instance['trend_duration'] );
		return $instance;
	}

	public function form( $instance ) {
		$title_latest   = isset( $instance['title_latest'] ) ? esc_attr( $instance['title_latest'] ) : __( 'Trending Post', 'beritaxx' );
		$fto_count      = isset( $instance['fto_count'] ) ? esc_attr( $instance['fto_count'] ) : 6;
		$float_dir    = isset( $instance['float_dir'] ) ? esc_attr( $instance['float_dir'] ) : 'right_dir';
		$trend_duration   = isset( $instance['trend_duration'] ) ? esc_attr( $instance['trend_duration'] ) : '-30 days';
		?>
		<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/widgets/silhouette/trending-overlay.png" />
		<p>
			<label for="<?php echo $this->get_field_id( 'title_latest' ); ?>"><?php echo __( 'Block Title', 'beritaxx' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title_latest' ); ?>" name="<?php echo $this->get_field_name( 'title_latest' ); ?>" type="text" value="<?php echo $title_latest; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title_trending' ); ?>"><?php echo __( 'Trending Range', 'beritaxx' ); ?></label>
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
		<p>
	    	<label for="<?php echo $this->get_field_id( 'fto_count' ); ?>"><?php echo __( 'Number of posts to show :', 'beritaxx' ); ?></label>
	    	<input class="widefat" id="<?php echo $this->get_field_id( 'fto_count' ); ?>" name="<?php echo $this->get_field_name( 'fto_count' ); ?>" type="number" value="<?php echo esc_attr( $fto_count ); ?>" />
		</p>
		<p>
	    	<label for="<?php echo $this->get_field_id('float_dir'); ?>"><?php _e( 'Number Position' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_name( 'float_dir' ); ?>" name="<?php echo $this->get_field_name( 'float_dir' ); ?>">
			    <option <?php selected( $instance['float_dir'], 'left_dir'); ?> value="left_dir"><?php echo __( 'Number in Left', 'beritaxx' ); ?></option>
				<option <?php selected( $instance['float_dir'], 'right_dir'); ?> value="right_dir"><?php echo __( 'Number in Right', 'beritaxx' ); ?></option>
			</select>
		</p>
		
		<?php
	}
}