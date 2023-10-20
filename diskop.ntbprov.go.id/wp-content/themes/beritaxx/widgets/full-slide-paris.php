<?php
class FullSlideParis extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'full_slide_paris',
			'description'                 => __( 'Category Slide Paris Style', 'beritaxx' ),
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct( 'fullslideparis', __( 'Paris Slide (Full)', 'beritaxx' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		
		$paris_cat = ( ! empty( $instance['paris_cat'] ) ) ? absint( $instance['paris_cat'] ) : '';
		
		echo $args['before_widget'];
		?>
		
		    <div class="paris_block">
				<?php
					$paris_arg = array( 
				    	'post_type' => 'post',
				    	'cat' => $paris_cat,
				    	'numberposts' => $number,
					); 
					global $post;
					$paris_news = get_posts($paris_arg);
					?>
					    <div class="parisslide paris_slide<?php echo $args['widget_id']; ?> owl-carousel owl-theme">
							<?php
								foreach ($paris_news as $post):
								setup_postdata($post); 
								?>
								
								<div class="item">
									<div class="paris__author taxx_clear">
										<?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?>
										<div class="paris__top">
									    	<span class="top_name"><span class="user_mini"><?php the_author(); ?></span></span>
											<span class="time_mini"><?php the_time(); ?></span>
										</div>
									</div>
									<div class="paris__featured">
									<?php 
										if (has_post_thumbnail()) { 
									    	the_post_thumbnail('berita', array(
												'alt' => trim(strip_tags($post->post_title)),
												'title' => trim(strip_tags($post->post_title)),
											)); 
										}
									?>
									</div>
									<div class="paris_slide_post">
										<div class="paris_slide_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
									</div>
								</div>
								
								<?php
								endforeach;
							?>
						</div>
								
								<script>
							    	jQuery(document).ready(function() {
										jQuery('.paris_slide<?php echo $args['widget_id']; ?>').owlCarousel({
											margin: 0,
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
												600:{
												    items:3
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
		$instance['paris_cat']    = (int) $new_instance['paris_cat'];
		return $instance;
	}

	public function form( $instance ) {
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$paris_cat    = isset( $instance['paris_cat'] ) ? absint( $instance['paris_cat'] ) : '';
		?>
		<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/widgets/silhouette/paris.png" />
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php echo __( 'Number of posts to show :', 'beritaxx' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'paris_cat' ); ?>"><?php echo __( 'Category :', 'beritaxx' ); ?></label>
            <select id="<?php echo $this->get_field_id('paris_cat'); ?>" name="<?php echo $this->get_field_name('paris_cat'); ?>" class="widefat" style="width:100%;">
                <?php 
				    $paris_terms = get_terms( array( 
					    'taxonomy' => 'category',
					    'parent' => 0,
						'hide_empty' => true,
					));
			    	foreach( $paris_terms as $paris ) { 
					?>
                    <option <?php selected( $instance['paris_cat'], $paris->term_id ); ?> value="<?php echo $paris->term_id; ?>"><?php echo $paris->name; ?></option>
                    <?php 
					} 
				?>      
            </select>
        </p>
		<?php
	}
}