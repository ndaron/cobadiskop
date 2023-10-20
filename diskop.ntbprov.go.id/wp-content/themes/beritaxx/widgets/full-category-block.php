<?php
class FullCatBlock extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'full_cat_block',
			'description'                 => __( 'Show 3 Category Block', 'beritaxx' ),
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct( 'fullcatblock', __( '3 Block Category (Full)', 'beritaxx' ), $widget_ops );
            
	}
	
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		$title_one   = ( ! empty( $instance['title_one'] ) ) ? $instance['title_one'] : __( 'Category 1', 'beritaxx' );
		$cat_one     = ( ! empty( $instance['cat_one'] ) ) ? $instance['cat_one'] : '';
		$title_two   = ( ! empty( $instance['title_two'] ) ) ? $instance['title_two'] : __( 'Category 2', 'beritaxx' );
		$cat_two     = ( ! empty( $instance['cat_two'] ) ) ? $instance['cat_two'] : '';
		$title_three = ( ! empty( $instance['title_three'] ) ) ? $instance['title_three'] : __( 'Category 3', 'beritaxx' );
		$cat_three   = ( ! empty( $instance['cat_three'] ) ) ? $instance['cat_three'] : '';
		
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title_one = apply_filters( 'widget_title', $title_one, $instance, $this->id_base );
		
		echo $args['before_widget'];
		?>
		    
		    <div class="cat_block_three beritaxx_widget<?php echo $args['widget_id']; ?>">
		    	<div class="cat_block_outer taxx_clear">
				    
					<div class="cat_block_block">
		    		    <div class="cat_block_inner">
					    	<?php 
						    	$late_args = array( 
							    	'post_type' => 'post', 
									'cat' => $cat_one,
									'numberposts' => 2,
									'ignore_sticky_posts' => 1,
									'post_status'       => 'publish',
								); 
								global $post;
								$get_catone = get_posts($late_args);
								$catone = 0;
								?>
								
								<div class="taxx_clear block_cat_one">
							    	<span class="cat_head_one"><?php if ( $title_one ) { echo $title_one; } ?></span>
									<?php 
								    	foreach ($get_catone as $post):
										setup_postdata($post); 
										$catone++;
										?>
								        	<div class="block_cat_box taxx_clear cat_<?php echo $catone; ?>">
										    	<div class="cat_one_img">
										        	<?php 
											        	if (has_post_thumbnail()) {
													    	the_post_thumbnail('berita', array(
													        	'alt' => trim(strip_tags($post->post_title)),
													    		'title' => trim(strip_tags($post->post_title)),
													    	));
												    	}
											    	?>
										    	</div>
												<div class="cat_one_overlay">
												    <div class="cat_one_inner">
												    	<div class="time_mini"><?php the_time(); ?></div>
														<div class="cat_one_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
														<div class="cat_one_after"><span class="com_mini"><i class="far fa-eye"></i> <?php echo getViews(get_the_ID()); ?></span> <span class="user_mini"><i class="far fa-user-circle"></i> <?php the_author(); ?></span></div>
												    </div>
												</div>
											</div>
										<?php
										endforeach; 
									?>
								</div>
						</div>
					</div>
					
					<div class="cat_block_block">
		    		    <div class="cat_block_inner">
					    	<?php 
						    	$late_args = array( 
							    	'post_type' => 'post',  
									'cat' => $cat_two,
									'numberposts' => 5,
									'ignore_sticky_posts' => 1,
									'post_status'       => 'publish',
								); 
								global $post;
								$get_cattwo = get_posts($late_args);
								?>
								
								<div class="taxx_clear">
							    	<h3 class="cat_head"><span><?php if ( $title_two ) { echo $title_two; } ?></span></h3>
									<?php 
								    	foreach ($get_cattwo as $post):
										setup_postdata($post); 
										?>
										    <div class="block_two_list taxx_clear">
										    	<div class="block_two_post">
											    	<div class="block_two_over">
													    <div class="time_mini"><?php the_time(); ?></div>
														<div class="block_two_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
														<div class="block_two_after"><span class="com_mini"><i class="far fa-eye"></i> <?php echo getViews(get_the_ID()); ?></span> <span class="user_mini"><i class="far fa-user-circle"></i> <?php the_author(); ?></span></div>
													</div>
												</div>
											</div>
										<?php
										endforeach; 
									?>
								</div>
						</div>
					</div>
					
					<div class="cat_block_block last_block">
		    		    <div class="cat_block_inner">
					    	<?php 
						    	$late_args = array( 
							    	'post_type' => 'post',  
									'cat' => $cat_three,
									'numberposts' => 3,
									'ignore_sticky_posts' => 1,
									'post_status'       => 'publish',
								); 
								global $post;
								$get_catthree = get_posts($late_args);
								$pecount = 0;
								
								?>
								
								<div class="taxx_clear">
							    	<h3 class="cat_head"><span><?php if ( $title_three ) { echo $title_three; } ?></span></h3>
									<?php 
								    	foreach ($get_catthree as $post):
										setup_postdata($post); 
										$pecount++;
										if ( $pecount == 1 ) {
										?>
								        	<div class="block_cat_top taxx_clear">
										    	<div class="cat_top_img">
										        	<?php 
											        	if (has_post_thumbnail()) {
													    	the_post_thumbnail('berita', array(
													        	'alt' => trim(strip_tags($post->post_title)),
													    		'title' => trim(strip_tags($post->post_title)),
													    	));
												    	}
											    	?>
										    	</div>
												<div class="cat_top_post">
											    	<div class="cat_top_over">
												    	<div class="time_mini"><?php the_time(); ?></div>
														<div class="cat_top_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
														<div class="cat_top_after"><span class="com_mini"><i class="far fa-eye"></i> <?php echo getViews(get_the_ID()); ?></span> <span class="user_mini"><i class="far fa-user-circle"></i> <?php the_author(); ?></span></div>
													</div>
												</div>
											</div>
										<?php
										} else {
										?>
											<div class="block_cat_bottom taxx_clear">
										    	<div class="block_cat_bottom_img">
										        	<?php 
											        	if (has_post_thumbnail()) {
													    	the_post_thumbnail('small', array(
													        	'alt' => trim(strip_tags($post->post_title)),
													    		'title' => trim(strip_tags($post->post_title)),
													    	));
												    	}
											    	?>
										    	</div>
												<div class="cat_bottom_post">
											    	<div class="cat_bottom_over">
														<div class="time_mini"><?php the_time(); ?></div>
														<div class="cat_top_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
														<div class="cat_top_after"><span class="com_mini"><i class="far fa-eye"></i> <?php echo getViews(get_the_ID()); ?></span> <span class="user_mini"><i class="far fa-user-circle"></i> <?php the_author(); ?></span></div>
													</div>
												</div>
											</div>
										<?php
										}
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
		$instance               = $old_instance;
		$instance['title_one']  = sanitize_text_field( $new_instance['title_one'] );
		$instance['cat_one']    = sanitize_text_field( $new_instance['cat_one'] );
		$instance['title_two']  = sanitize_text_field( $new_instance['title_two'] );
		$instance['cat_two']    = sanitize_text_field( $new_instance['cat_two'] );
		$instance['title_three']  = sanitize_text_field( $new_instance['title_three'] );
		$instance['cat_three']    = sanitize_text_field( $new_instance['cat_three'] );
		return $instance;
	}

	public function form( $instance ) {
		$title_one   = isset( $instance['title_one'] ) ? esc_attr( $instance['title_one'] ) : __( 'Category 1', 'beritaxx' );
		$cat_one     = isset( $instance['cat_one'] ) ? esc_attr( $instance['cat_one'] ) : '';
		$title_two   = isset( $instance['title_two'] ) ? esc_attr( $instance['title_two'] ) : __( 'Category 2', 'beritaxx' );
		$cat_two     = isset( $instance['cat_two'] ) ? esc_attr( $instance['cat_two'] ) : '';
		$title_three   = isset( $instance['title_three'] ) ? esc_attr( $instance['title_three'] ) : __( 'Category 3', 'beritaxx' );
		$cat_three     = isset( $instance['cat_three'] ) ? esc_attr( $instance['cat_three'] ) : '';
		?>
		<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/widgets/silhouette/full-cat-block.png" />
		<p>
			<label for="<?php echo $this->get_field_id( 'title_one' ); ?>"><?php echo __( 'Block 1 Title', 'beritaxx' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'title_one' ); ?>" name="<?php echo $this->get_field_name( 'title_one' ); ?>" type="text" value="<?php echo $title_one; ?>"/>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'cat_one' ); ?>"><?php echo __( 'Category :', 'beritaxx' ); ?></label>
            <select id="<?php echo $this->get_field_id('cat_one'); ?>" name="<?php echo $this->get_field_name('cat_one'); ?>" class="widefat" style="width:100%;">
                <?php 
				    $small_terms = get_terms( array( 
					    'taxonomy' => 'category',
					    'parent' => 0,
						'hide_empty' => true,
					));
			    	foreach( $small_terms as $term ) { 
					?>
                    <option <?php selected( $instance['cat_one'], $term->term_id ); ?> value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
                    <?php 
					} 
				?>      
            </select>
        </p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title_two' ); ?>"><?php echo __( 'Block 2 Title', 'beritaxx' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'title_two' ); ?>" name="<?php echo $this->get_field_name( 'title_two' ); ?>" type="text" value="<?php echo $title_two; ?>"/>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'cat_two' ); ?>"><?php echo __( 'Category :', 'beritaxx' ); ?></label>
            <select id="<?php echo $this->get_field_id('cat_two'); ?>" name="<?php echo $this->get_field_name('cat_two'); ?>" class="widefat" style="width:100%;">
                <?php 
				    $small_terms = get_terms( array( 
					    'taxonomy' => 'category',
					    'parent' => 0,
						'hide_empty' => true,
					));
			    	foreach( $small_terms as $term ) { 
					?>
                    <option <?php selected( $instance['cat_two'], $term->term_id ); ?> value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
                    <?php 
					} 
				?>      
            </select>
        </p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title_three' ); ?>"><?php echo __( 'Block 3 Title', 'beritaxx' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'title_three' ); ?>" name="<?php echo $this->get_field_name( 'title_three' ); ?>" type="text" value="<?php echo $title_three; ?>"/>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'cat_three' ); ?>"><?php echo __( 'Category :', 'beritaxx' ); ?></label>
            <select id="<?php echo $this->get_field_id('cat_three'); ?>" name="<?php echo $this->get_field_name('cat_three'); ?>" class="widefat" style="width:100%;">
                <?php 
				    $small_terms = get_terms( array( 
					    'taxonomy' => 'category',
					    'parent' => 0,
						'hide_empty' => true,
					));
			    	foreach( $small_terms as $term ) { 
					?>
                    <option <?php selected( $instance['cat_three'], $term->term_id ); ?> value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
                    <?php 
					} 
				?>      
            </select>
        </p>
		<span class="widget_lite_title"><?php echo __( 'Beritaxx Widget', 'beritaxx' ); ?></span>
		
		<?php
	}
}