<?php
class FullSmallSlide extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'full_bsmall_slide',
			'description'                 => __( 'Slide width mini thumbnail', 'beritaxx' ),
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct( 'fullsmallslide', __( 'Small Slide (Full)', 'beritaxx' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		
		$small_cat = ( ! empty( $instance['small_cat'] ) ) ? absint( $instance['small_cat'] ) : '';
		
		echo $args['before_widget'];
		?>
		
		    <div class="full_small_slide">
		    	<div class="small_slide_outer taxx_clear">
				    
					<!-- FEATURED -->
			    	<div class="small_slide_block">
				    	<div class="small_slide_inner">
						    <?php
							    $small_args = array( 
							    	'post_type' => 'post', 
									'cat' => $small_cat,
									'numberposts' => $number,
								); 
								global $post;
								$small_news = get_posts($small_args);
								?>
								
								<div class="smallslide fullslide<?php echo $args['widget_id']; ?> owl-carousel owl-theme">
							    	<?php
								    	foreach ($small_news as $post):
										setup_postdata($post); 
										?>
								        	<div class="item">
										    	<?php 
											    	if (has_post_thumbnail()) { 
												    	the_post_thumbnail('small', array(
													    	'alt' => trim(strip_tags($post->post_title)),
													    	'title' => trim(strip_tags($post->post_title)),
														)); 
													}
												?>
												<div class="small_slide_post">
											    	<div class="time_mini"><?php the_time(); ?></div>
													<div class="small_slide_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
												</div>
											</div>
								    	<?php
										endforeach;
									?>
								</div>
								
								<script>
							    	jQuery(document).ready(function() {
										jQuery('.fullslide<?php echo $args['widget_id']; ?>').owlCarousel({
											margin: 30,
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
											    	items: 1,
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
					
				</div>
			</div>
			
		<?php
		
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['number']    = (int) $new_instance['number'];
		$instance['small_cat']    = (int) $new_instance['small_cat'];
		return $instance;
	}

	public function form( $instance ) {
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$small_cat    = isset( $instance['small_cat'] ) ? absint( $instance['small_cat'] ) : '';
		?>
		<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/widgets/silhouette/smallslide-full.png" />
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php echo __( 'Number of posts to show :', 'beritaxx' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'small_cat' ); ?>"><?php echo __( 'Category :', 'beritaxx' ); ?></label>
            <select id="<?php echo $this->get_field_id('small_cat'); ?>" name="<?php echo $this->get_field_name('small_cat'); ?>" class="widefat" style="width:100%;">
                <?php 
				    $small_terms = get_terms( array( 
					    'taxonomy' => 'category',
					    'parent' => 0,
						'hide_empty' => true,
					));
			    	foreach( $small_terms as $term ) { 
					?>
                    <option <?php selected( $instance['small_cat'], $term->term_id ); ?> value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
                    <?php 
					} 
				?>      
            </select>
        </p>
		<?php
	}
}