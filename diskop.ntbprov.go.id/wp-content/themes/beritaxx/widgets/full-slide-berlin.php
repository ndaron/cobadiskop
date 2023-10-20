<?php
class FullSlideBerlin extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'full_slide_berlin',
			'description'                 => __( 'Category Slide Berlin Style', 'beritaxx' ),
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct( 'fullslideberlin', __( 'Berlin Slide (Full)', 'beritaxx' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		
		$berlin_cat = ( ! empty( $instance['berlin_cat'] ) ) ? absint( $instance['berlin_cat'] ) : '';
		
		echo $args['before_widget'];
		?>
		
		    <div class="berlin_block">
				<?php
					$berlin_arg = array( 
				    	'post_type' => 'post',
				    	'cat' => $berlin_cat,
				    	'numberposts' => $number,
					); 
					global $post;
					$berlin_news = get_posts($berlin_arg);
					?>
					    <div class="berlinslide berlin_slide<?php echo $args['widget_id']; ?> owl-carousel owl-theme">
							<?php
								foreach ($berlin_news as $post):
								setup_postdata($post); 
								?>
								
								<div class="item">
								    <span class="com_mini"><i class="far fa-eye"></i> <?php echo getViews(get_the_ID()); ?></span>
									<div class="berlin__featured">
									<?php 
										if (has_post_thumbnail()) { 
									    	the_post_thumbnail('berita', array(
												'alt' => trim(strip_tags($post->post_title)),
												'title' => trim(strip_tags($post->post_title)),
											)); 
										}
									?>
									</div>
									<div class="berlin_slide_post">
									    <div class="berlin__top">
									    	<span class="time_mini"><?php the_time(); ?></span>
										</div>
										<div class="berlin_slide_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
										<div class="berlin__top">
									    	<span class="top_name"><span class="user_mini"><i class="far fa-user-circle"></i> <?php the_author(); ?></span></span>
										</div>
									</div>
								</div>
								
								<?php
								endforeach;
							?>
						</div>
								
								<script>
							    	jQuery(document).ready(function() {
										jQuery('.berlin_slide<?php echo $args['widget_id']; ?>').owlCarousel({
											margin: 20,
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
											    	items:2,
												},
												520:{
												    items:2
												},
												640:{
												    items:2
												},
												768:{
												    items:3
												},
												982:{
													items:4
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
		$instance['berlin_cat']    = (int) $new_instance['berlin_cat'];
		return $instance;
	}

	public function form( $instance ) {
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$berlin_cat    = isset( $instance['berlin_cat'] ) ? absint( $instance['berlin_cat'] ) : '';
		?>
		<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/widgets/silhouette/berlin.png" />
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php echo __( 'Number of posts to show :', 'beritaxx' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'berlin_cat' ); ?>"><?php echo __( 'Category :', 'beritaxx' ); ?></label>
            <select id="<?php echo $this->get_field_id('berlin_cat'); ?>" name="<?php echo $this->get_field_name('berlin_cat'); ?>" class="widefat" style="width:100%;">
                <?php 
				    $berlin_terms = get_terms( array( 
					    'taxonomy' => 'category',
					    'parent' => 0,
						'hide_empty' => true,
					));
			    	foreach( $berlin_terms as $berlin ) { 
					?>
                    <option <?php selected( $instance['berlin_cat'], $berlin->term_id ); ?> value="<?php echo $berlin->term_id; ?>"><?php echo $berlin->name; ?></option>
                    <?php 
					} 
				?>      
            </select>
        </p>
		<?php
	}
}