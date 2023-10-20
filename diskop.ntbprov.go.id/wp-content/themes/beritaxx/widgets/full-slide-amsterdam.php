<?php
class FullSlideAmsterdam extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'full_slide_amsterdam',
			'description'                 => __( 'Category Slide Amsterdam Style', 'beritaxx' ),
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct( 'fullslideamsterdam', __( 'Amsterdam Slide (Full)', 'beritaxx' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		
		$amsterdam_cat = ( ! empty( $instance['amsterdam_cat'] ) ) ? absint( $instance['amsterdam_cat'] ) : '';
		
		echo $args['before_widget'];
		?>
		
		    <div class="amsterdam_block">
				<?php
					$amsterdam_arg = array( 
				    	'post_type' => 'post',
				    	'cat' => $amsterdam_cat,
				    	'numberposts' => $number,
					); 
					global $post;
					$amsterdam_news = get_posts($amsterdam_arg);
					?>
					    <div class="amsterdamslide amsterdam_slide<?php echo $args['widget_id']; ?> owl-carousel owl-theme">
							<?php
								foreach ($amsterdam_news as $post):
								setup_postdata($post); 
								?>
								
								<div class="item">
									<div class="amsterdam__featured">
								    	<?php 
									    	if (has_post_thumbnail()) { 
									        	the_post_thumbnail('thumbnail', array(
										    		'alt' => trim(strip_tags($post->post_title)),
										    		'title' => trim(strip_tags($post->post_title)),
										    	)); 
									    	}
								    	?>
										<div class="amsterdam_slide_post">
									    	<span class="time_mini"><?php the_time(); ?></span> <span class="com_mini"><i class="far fa-eye"></i> <?php echo getViews(get_the_ID()); ?></span>
									    	<div class="amsterdam_slide_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
								    	</div>
								 	</div>
									
								</div>
								
								<?php
								endforeach;
							?>
						</div>
								
								<script>
							    	jQuery(document).ready(function() {
										jQuery('.amsterdam_slide<?php echo $args['widget_id']; ?>').owlCarousel({
											margin: 15,
											loop: true,
											nav: false,
											dots: false,
											lazyLoad: true,
											autoplay: true,
											smartSpeed: 1000,
											autoplayTimeout: 4000,
											autoplayHoverPause: false,
											responsive:{
												0:{ 
											    	items:1,
												},
												600:{
												    items:2
												},
												982:{
													items:3
												}
											}  
										})
									});
								</script>
							
			</div>
			
		<?php
		
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['number']    = (int) $new_instance['number'];
		$instance['amsterdam_cat']    = (int) $new_instance['amsterdam_cat'];
		return $instance;
	}

	public function form( $instance ) {
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$amsterdam_cat    = isset( $instance['amsterdam_cat'] ) ? absint( $instance['amsterdam_cat'] ) : '';
		?>
		<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/widgets/silhouette/amsterdam.png" />
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php echo __( 'Number of posts to show :', 'beritaxx' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'amsterdam_cat' ); ?>"><?php echo __( 'Category :', 'beritaxx' ); ?></label>
            <select id="<?php echo $this->get_field_id('amsterdam_cat'); ?>" name="<?php echo $this->get_field_name('amsterdam_cat'); ?>" class="widefat" style="width:100%;">
                <?php 
				    $amsterdam_terms = get_terms( array( 
					    'taxonomy' => 'category',
					    'parent' => 0,
						'hide_empty' => true,
					));
			    	foreach( $amsterdam_terms as $amsterdam ) { 
					?>
                    <option <?php selected( $instance['amsterdam_cat'], $amsterdam->term_id ); ?> value="<?php echo $amsterdam->term_id; ?>"><?php echo $amsterdam->name; ?></option>
                    <?php 
					} 
				?>      
            </select>
        </p>
		<?php
	}
}