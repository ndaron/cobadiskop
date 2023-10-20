
		<meta name="description" content="<?php head_meta_desc_beritaxx(); ?>" />
		<link rel="profile" href="https://gmpg.org/xfn/11" />
		<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
		<meta property="og:locale" content="id_ID" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?php is_front_page() ? bloginfo('name') : wp_title(''); ?>" />
        <meta property="og:description" content="<?php head_meta_desc_beritaxx(); ?>" />
		<?php 
		    global $wp;
			$cururl = add_query_arg( $wp->query_vars, home_url( $wp->request ) );
		?>
		<meta property="og:url" content="<?php echo esc_attr( $cururl ); ?>" />
        <meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="<?php is_front_page() ? bloginfo('name') : wp_title(''); ?>" />
        <meta name="twitter:description" content="<?php head_meta_desc_beritaxx(); ?>" />
		<?php 
		    if ( is_singular() ) {  
			    if (have_posts()):
				    while (have_posts()): the_post(); 
					
					    $thumb_id = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
						if (has_post_thumbnail()) { 
                            echo '<meta property="og:image" content="'. esc_attr( $thumb_url[0] ) .'" />';
					    	echo '<meta property="og:image:secure_url" content="'. esc_attr( $thumb_url[0] ) .'" />';
					    	echo '<meta name="twitter:image" content="'. esc_attr( $thumb_url[0] ).'" />';							
						} else {
							if ( get_theme_mod('beritaxx_default_thumbnail') != "" ) {
								echo '<meta property="og:image" content="'. esc_attr( get_theme_mod('beritaxx_default_thumbnail_share') ).'" />';
								echo '<meta property="og:image:secure_url" content="'. esc_attr( get_theme_mod('beritaxx_default_thumbnail_share') ).'" />';
								echo '<meta name="twitter:image" content="'. esc_attr( get_theme_mod('beritaxx_default_thumbnail_share') ).'" />';
							} else {
								echo '<meta property="og:image" content="'. esc_attr( get_theme_file_uri('images/share.jpg') ).'" />';
								echo '<meta property="og:image:secure_url" content="'. esc_attr( get_theme_file_uri('images/share.jpg') ).'" />';
								echo '<meta name="twitter:image" content="'. esc_attr( get_theme_file_uri('images/share.jpg') ).'" />';
							}
						}
					endwhile;
				endif; 
		    } else if ( is_page() ) { 
			    if (have_posts()):
				    while (have_posts()): the_post(); 
					
					    $thumb_id = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
						if (has_post_thumbnail()) { 
                            echo '<meta property="og:image" content="'. esc_attr( $thumb_url[0] ).'" />';
					    	echo '<meta property="og:image:secure_url" content="'. esc_attr( $thumb_url[0] ).'" />';
					    	echo '<meta name="twitter:image" content="'. esc_attr( $thumb_url[0] ).'" />';							
						} else {
							if ( get_theme_mod('beritaxx_default_thumbnail_share') != "" ) {
								echo '<meta property="og:image" content="'. esc_attr( get_theme_mod('beritaxx_default_thumbnail_share') ).'" />';
								echo '<meta property="og:image:secure_url" content="'. esc_attr( get_theme_mod('beritaxx_default_thumbnail_share') ).'" />';
								echo '<meta name="twitter:image" content="'. esc_attr( get_theme_mod('beritaxx_default_thumbnail_share') ).'" />';
							} else {
								echo '<meta property="og:image" content="'. esc_attr( get_theme_file_uri('images/share.jpg') ).'" />';
								echo '<meta property="og:image:secure_url" content="'. esc_attr( get_theme_file_uri('images/share.jpg') ).'" />';
								echo '<meta name="twitter:image" content="'. esc_attr( get_theme_file_uri('images/share.jpg') ).'" />';
							}
						}
					endwhile;
				endif; 
			} else {
			    if ( get_theme_mod('beritaxx_default_thumbnail_share') != "" ) {
		        	echo '<meta property="og:image" content="'. esc_attr( get_theme_mod('beritaxx_default_thumbnail_share') ).'" />';
					echo '<meta property="og:image:secure_url" content="'. esc_attr( get_theme_mod('beritaxx_default_thumbnail_share') ).'" />';
					echo '<meta name="twitter:image" content="'. esc_attr( get_theme_mod('beritaxx_default_thumbnail_share') ).'" />';
				} else {
					echo '<meta property="og:image" content="'. esc_attr( get_theme_file_uri('images/share.jpg') ).'" />';
					echo '<meta property="og:image:secure_url" content="'. esc_attr( get_theme_file_uri('images/share.jpg') ).'" />';
					echo '<meta name="twitter:image" content="'. esc_attr( get_theme_file_uri('images/share.jpg') ).'" />';
				}
			} 
		?>