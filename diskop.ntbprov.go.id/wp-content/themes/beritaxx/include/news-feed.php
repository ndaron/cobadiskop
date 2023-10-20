<?php

    function news_feed_on_dashboard() {
    	global $wp_meta_boxes;
	    unset(
		    $wp_meta_boxes['dashboard']['side']['core']['dashboard_plugins'],
			$wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'],
			$wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']
		);
		add_meta_box( 'id', 'News Feed', 'news_feed_custom_output', 'dashboard', 'normal', 'high' );
	}
			
	function news_feed_custom_output() {
		
		$my_theme = wp_get_theme();
		?>
	    
		<div class="feed_widget">
		    <div class="taxx_clear top_feed">
			    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/beritaxx.png" /> <span><?php echo esc_html( $my_theme->get( 'Name' ) ) . ' ' .esc_html( $my_theme->get( 'Version' ) ); ?></span>
				<a href="https://beritaxx.com/problem/" target="_blank" class="button button-primary"><?php echo __( 'Q & A', 'beritaxx' ); ?></a>
			</div>
			<?php
		        // Call feed URL	
				wp_widget_rss_output( array(
			        'url' => esc_url('https://beritaxx.com/feed'),
			        'items' => 5,
			        'show_summary' => 0,
			        'show_author' => 0,
			        'show_date' => 1
				) );
			    $current_user = wp_get_current_user();
            ?>
			
		</div>
		
		<?php
		}
		
	add_action('wp_dashboard_setup', 'news_feed_on_dashboard');