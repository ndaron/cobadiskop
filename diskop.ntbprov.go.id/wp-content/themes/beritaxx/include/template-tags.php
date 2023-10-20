<?php

// Custom Logo
if ( ! function_exists( 'taxx_custom_logo' ) ) :
    function taxx_custom_logo() {
    	if ( function_exists( 'the_custom_logo' ) ) {
			    the_custom_logo();
	    }
    }
endif;
// Switch Header
function beritaxx_customize_partial_headerswitch() {
	taxx_header_switch();
}
if ( ! function_exists( 'taxx_header_switch' ) ) :
    function taxx_header_switch() {
    	if ( get_theme_mod('header_switch') != "" ) {
			get_template_part('header/' . get_theme_mod('header_switch'));
	    }
    }
endif;
// Head Search
if ( ! function_exists( 'taxx_search_news' ) ) :
    function taxx_search_news() {
    	get_template_part('top-content/search');
    }
endif;

// Social Media
function beritaxx_customize_partial_facebook() {
	beritaxx_social_icon();
}
function beritaxx_customize_partial_twitter() {
	beritaxx_social_icon();
}
function beritaxx_customize_partial_instagram() {
	beritaxx_social_icon();
}
function beritaxx_customize_partial_youtube() {
	beritaxx_social_icon();
}
if ( ! function_exists( 'beritaxx_social_icon' ) ) :
	function beritaxx_social_icon() {
		if ( get_theme_mod('facebook_data') != "" ) {
	        echo '<a target="_blank" href="'. esc_url( get_theme_mod( 'facebook_data' ) ).'" target="_blank"><i class="fab fa-facebook"></i></a>';
	    }
		if ( get_theme_mod('twitter_data') != "" ) {
	        echo '<a target="_blank" href="'. esc_url( get_theme_mod( 'twitter_data' ) ).'" target="_blank"><i class="fab fa-twitter"></i></a>';
	    }
		if ( get_theme_mod('instagram_data') != "" ) {
	        echo '<a target="_blank" href="'. esc_url( get_theme_mod( 'instagram_data' ) ).'" target="_blank"><i class="fab fa-instagram"></i></a>';
	    }
		if ( get_theme_mod('youtube_data') != "" ) {
	        echo '<a target="_blank" href="'. esc_url( get_theme_mod( 'youtube_data' ) ).'" target="_blank"><i class="fab fa-youtube"></i></a>';
	    }
	}
endif;

// Single Related Post Type
if ( ! function_exists( 'post_related_by_category' ) ) :
	function post_related_by_category() {
		get_template_part('content/related-post');
	}
endif;

// Meta Header
if ( ! function_exists( 'beritaxx_head_meta' ) ) :
    function beritaxx_head_meta() {
        get_template_part('header/meta');
	}
endif;

// Description
if ( ! function_exists( 'head_meta_desc_beritaxx' ) ) :
    function head_meta_desc_beritaxx() {
		if (is_front_page()) {
			bloginfo('description');
		} else if (is_singular()) {
			if (function_exists('smart_excerpt')) smart_excerpt(get_the_excerpt(), 60);
		} else {
			echo '';
		}
	}
endif;


function beritaxx_customize_partial_footerlogo() {
	taxx_footer_logo();
}
if ( ! function_exists( 'taxx_footer_logo' ) ) :
    function taxx_footer_logo() {
		if ( get_theme_mod('beritaxx_footer_logo') != "" ) {
	        echo '<img src="'. esc_url( get_theme_mod( 'beritaxx_footer_logo' ) ).'"/>';
	    } else {
			echo '';
		}
	}
endif;
function beritaxx_customize_partial_footertext() {
	taxx_footer_text();
}
if ( ! function_exists( 'taxx_footer_text' ) ) :
    function taxx_footer_text() {
		if ( get_theme_mod('beritaxx_footer_text') != "" ) {
	        echo esc_html( get_theme_mod( 'beritaxx_footer_text' ) );
	    } else {
			echo __( 'Fresh design for News category WordPress theme', 'beritaxx' );
		}
	}
endif;

// Footer
function beritaxx_customize_partial_copyright() {
	taxx_text_footer();
}
if ( ! function_exists( 'taxx_text_footer' ) ) :
	function taxx_text_footer() {
		if ( get_theme_mod('beritaxx_footer_copyright') != "" ) {
			echo esc_html( get_theme_mod('beritaxx_footer_copyright') );
		} else {
	    	$webname = get_bloginfo('name');
	    	echo sprintf(__('&copy; %1$s. Beritaxx theme created by <a href="%2$s">Team XX</a>. Proudly powered by <a href="%3$s">WordPress</a>', 'beritaxx' ), $webname, 'https://beritaxx.com/teamxx', 'https://wordpress.org' );
    	}
	}
endif;




// Ads
function beritaxx_customize_partial_headerads() {
	taxx_header_ads();
}
if ( ! function_exists( 'taxx_header_ads' ) ) :
    function taxx_header_ads() {
		if ( get_theme_mod('beritaxx_ads_afterheader') != "" ) {
			echo '<div class="inner_header_ads">';
	        echo html_entity_decode( get_theme_mod( 'beritaxx_ads_afterheader' ) );
			echo '</div>';
	    } else {
			echo '';
		}
	}
endif;
function beritaxx_customize_partial_floatingleft() {
	taxx_floating_left();
}
if ( ! function_exists( 'taxx_floating_left' ) ) :
    function taxx_floating_left() {
		if ( get_theme_mod('beritaxx_left_floating') != "" ) {
			echo '<div class="side_float"><span>x</span>';
	        echo html_entity_decode( get_theme_mod( 'beritaxx_left_floating' ) );
			echo '</div>';
	    } else {
			echo '';
		}
	}
endif;

function beritaxx_customize_partial_floatingright() {
	taxx_floating_right();
}
if ( ! function_exists( 'taxx_floating_right' ) ) :
    function taxx_floating_right() {
		if ( get_theme_mod('beritaxx_right_floating') != "" ) {
			echo '<div class="side_float"><span>x</span>';
	        echo html_entity_decode( get_theme_mod( 'beritaxx_right_floating' ) );
			echo '</div>';
	    } else {
			echo '';
		}
	}
endif;

function beritaxx_customize_partial_beforefooter() {
	taxx_before_footer();
}
if ( ! function_exists( 'taxx_before_footer' ) ) :
    function taxx_before_footer() {
		if ( get_theme_mod('beritaxx_ads_beforefooter') != "" ) {
	        echo html_entity_decode( get_theme_mod( 'beritaxx_ads_beforefooter' ) );
	    } else {
			echo '';
		}
	}
endif;

function beritaxx_customize_partial_bottomads() {
	taxx_bottom_ads_floating();
}
if ( ! function_exists( 'taxx_bottom_ads_floating' ) ) :
    function taxx_bottom_ads_floating() {
		if ( get_theme_mod('beritaxx_ads_bottom') != "" ) {
			echo '<div class="bottom_float"><span>x</span>';
	        echo html_entity_decode( get_theme_mod( 'beritaxx_ads_bottom' ) );
			echo '</div>';
	    } else {
			echo '';
		}
	}
endif;


function beritaxx_facebook_pixel() {
		if ( get_theme_mod('beritaxx_pixel_code') != "" ) {
			?>
	        <!-- Meta Pixel Code -->
	        <script>
	        !function(f,b,e,v,n,t,s)
	        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	        n.queue=[];t=b.createElement(e);t.async=!0;
	        t.src=v;s=b.getElementsByTagName(e)[0];
	        s.parentNode.insertBefore(t,s)}(window, document,'script',
	        'https://connect.facebook.net/en_US/fbevents.js');
	        fbq('init', '<?php echo esc_html( get_theme_mod('beritaxx_pixel_code') ); ?>');
	        fbq('track', 'PageView');
	        </script>
	        <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?php echo rawurlencode( get_theme_mod('beritaxx_pixel_code') ); ?>&ev=PageView&noscript=1" /></noscript>
            <!-- End Meta Pixel Code -->
			<?php
		}
}
add_action('wp_footer', 'beritaxx_facebook_pixel');

function head_customizer_style() {
	echo '<style type="text/css">'; 
	$headings_font = esc_html(get_theme_mod('beritaxxfont_heading'));
	$body_font = get_theme_mod('beritaxxfont_global');
	
	if ( $body_font ) {
		$font_pieces = explode(":", $body_font);
		echo "body, button, input, select, textarea { font-family: {$font_pieces[0]}; }"."\n";
	}
	
	if ( $headings_font ) {
		$font_pieces = explode(":", $headings_font);
		echo "h1, h2, h3, h4, h5, h6 { font-family: {$font_pieces[0]}; }"."\n";
	}
	?>
	
	body, button, input, select, textarea {
		font-size: <?php if ( get_theme_mod('beritaxxfontsize_global') != "" ) {
	    	echo esc_html( get_theme_mod( 'beritaxxfontsize_global') ); 
		} else {
			echo 14;
		} ?>px;
	}
	.beritaxx_article {
		font-size: <?php if ( get_theme_mod('beritaxxfontsize_article') != "" ) {
	    	echo esc_html( get_theme_mod( 'beritaxxfontsize_article') ); 
		} else {
			echo 16;
		} ?>px;
	}
	<?php
	echo '</style>';
}
add_action( 'wp_head', 'head_customizer_style' );

function beritaxx_no_lite_host() {
    return preg_replace("(^https?://)", "", site_url());
}

function beritaxx_pro_library_encrypt($string, $length = 16)
{
    $secret_key = 'AUTH_KEY';
    $secret_iv = 'AUTH_SALT';

    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, $length);

    return base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
}

function beritaxx_pro_library_decrypt($string, $length = 16)
{
    $secret_key = 'AUTH_KEY';
    $secret_iv = 'AUTH_SALT';

    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, $length);

    return openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
}

function beritaxx_customize_partial_loopbyuser() {
	loop_post_layout_by_user();
}
if ( ! function_exists( 'loop_post_layout_by_user' ) ) :
    function loop_post_layout_by_user() {
		if ( get_theme_mod('loop_by_user') != "" ) {
	        echo get_template_part( 'content/' . get_theme_mod( 'loop_by_user' ) );
	    } else {
			echo get_template_part( 'content/default');
		}
	}
endif;