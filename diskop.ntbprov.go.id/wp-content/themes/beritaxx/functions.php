<?php

if ( version_compare( $GLOBALS['wp_version'], '5.8', '<' ) ) {
	// WordPress Minimum Version
	require get_template_directory() . '/include/back-compat.php';
}

load_theme_textdomain( 'beritaxx', get_template_directory() . '/languages' );

function the_global_content_width() {
	// Global Width Content
	$GLOBALS['content_width'] = apply_filters( 'the_global_content_width', 840 );
}
add_action( 'after_setup_theme', 'the_global_content_width', 0 );

if ( ! function_exists( 'the_berita_setup' ) ) :
    function the_berita_setup() {
		
		// Head Title
    	add_theme_support( 'title-tag' );
		// Custom Logo
		add_theme_support( 'custom-logo', array(
	    	'height'      => 240,
	    	'width'       => 600,
	    	'flex-height' => true,
    	) );
		// Thumbnail Size;
	    add_theme_support( 'post-thumbnails' );
		add_image_size( 'berita', 320, 240, true );
		add_image_size( 'slide', 600, 450, true );
    	add_image_size( 'small', 80, 60, true );
		
		add_theme_support( 'html5', array(
	    	'search-form', 'comment-form', 'comment-list',
    	));
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'automatic-feed-links' );
		
		// Navigation
		register_nav_menus(array(
	    	'navigation' => __( 'Location Header Navigation', 'beritaxx' ),
    	));
		register_nav_menus(array(
	    	'footerone' => __( 'Location Footer 1', 'beritaxx' ),
    	));
		register_nav_menus(array(
	    	'footertwo' => __( 'Location Footer 2', 'beritaxx' ),
    	));
		register_nav_menus(array(
	    	'footerthree' => __( 'Location Footer 3', 'beritaxx' ),
    	));
		
    }

endif;
add_action( 'after_setup_theme', 'the_berita_setup' );

show_admin_bar( false );

function berita_feed_cache( $seconds ) {
  // change the default feed cache recreation period to 120 seconds;
  return 120;
}
add_filter( 'wp_feed_cache_transient_lifetime' , 'berita_feed_cache' ); 

/**
 * Functional.
 */


require get_template_directory() . '/include/customizer.php';
require get_template_directory() . '/include/template-tags.php';
require get_template_directory() . '/include/template-cats.php';
require get_template_directory() . '/include/theme-color.php';
require get_template_directory() . '/include/partialrefresh.php';
require get_template_directory() . '/include/custom-fonts.php';
require get_template_directory() . '/include/user-profile.php';
require get_template_directory() . '/include/news-feed.php';

/**
 * Default Item Per Page.
 */
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
	update_option( 'posts_per_page', 10 );
}

/**
 * Pagination.
 */
function berita_pagination() {

	if ( is_singular() )
		return;
	global $wp_query;

	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );
	if ( $paged >= 1 )
		$links[] = $paged;
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? 'active' : 'normal';
		printf( '<a%s href="%s">%s</a>' . "\n", ' class="'. esc_attr( $class ) .'"', esc_url( get_pagenum_link( 1 ) ), '1' );
		if ( ! in_array( 2, $links ) )
			echo ' … ';
	}

	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? 'active' : 'normal';
		printf( '<a%s href="%s">%s</a>' . "\n", ' class="'. esc_attr( $class ) .'"', esc_url( get_pagenum_link( $link ) ), esc_html( $link ) );
	}

	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo ' … ' . "\n";
		$class = $paged == $max ? 'active' : 'normal';
		printf( '<a%s href="%s">%s</a>' . "\n", ' class="'. esc_attr( $class ) .'"', esc_url( get_pagenum_link( $max ) ), esc_html( $max ) );
	}

}

/**
 * Reading Time.
 */
function reading_time() {
	global $post;
	$content = get_post_field( 'post_content', $post->ID );
	$word_count = str_word_count( strip_tags( $content ) );
	$readingtime = ceil($word_count / 200);
	
	$timer = __( 'minutes', 'beritaxx' );
	
	$totalreadingtime = $readingtime . ' ' . $timer;

    return $totalreadingtime;
}

/**
 * Popular Post.
 */
function beritaxx_popular_posts( $post_id ) {
	$count_key = 'popular_posts';
	$count = get_post_meta( $post_id, $count_key, true );
	if ($count == '') {
		$count = 0;
		delete_post_meta( $post_id, $count_key );
		add_post_meta( $post_id, $count_key, '0' );
	} else {
		$count++;
		update_post_meta( $post_id, $count_key, $count );
	}
}
function beritaxx_track_posts($post_id) {
	if ( !is_single() ) return;
	if ( empty( $post_id ) ) {
		global $post;
		$post_id = $post->ID;
	}
	beritaxx_popular_posts( $post_id );
}
add_action('wp_head', 'beritaxx_track_posts');

function getViews( $postID ){ 
    $count_key = 'post_views_count'; 
	$count = get_post_meta( $postID, $count_key, true ); 
	
	if( $count == '' ){ 
    	delete_post_meta( $postID, $count_key ); 
    	add_post_meta( $postID, $count_key, '0' ); return "0 View"; 
	} 
	return $count; 
} 
	
function settViews( $postID ) { 
    $count_key = 'post_views_count'; 
	$count = get_post_meta( $postID, $count_key, true ); 
	
	if( $count=='' ){ 
    	$count = 0; delete_post_meta( $postID, $count_key ); 
    	add_post_meta( $postID, $count_key, '0' ); 
	} else { 
    	$count++; 
    	update_post_meta( $postID, $count_key, $count ); 
	} 
}

/**
 * Smart Excerpt.
 */
function new_excerpt_length( $length ) {
	return 200;
}
add_filter( 'excerpt_length', 'new_excerpt_length' );

function smart_excerpt( $string, $limit ) {
	$words = explode( " ", $string );
	if ( count( $words ) >= $limit ) {
		$dots = '..';
	} else {
		$dots = '';
	}
	echo implode( " ", array_splice( $words, 0, $limit ) ).esc_html( $dots );
}

/**
 * Rest Change Media.
 */
function media_rest_change( $result, $server, $request ) {
	$method = $request->get_method();
	if ( 'GET' !== $method ) {
		return $result;
	}

	$url = $request->get_route();
	if ( ! is_user_logged_in() || ( false === strpos( $url, '/wp/v2/media/' ) ) ) {
		return $result;
	}

	if ( 'edit' === $request->get_param( 'context' ) ) {
		$request->set_param( 'context', 'view' );
	}

	return $result;
}

add_filter( 'rest_pre_dispatch', 'media_rest_change', 10, 3 );

/**
 * Comment List.
 */
function commentslist( $comment, $args, $depth ) { 
    ?>
	
	    <div class="beritaxx_comment taxx_clear">
		    <div class="comment__avatar">
		        <?php if ( get_avatar( $comment ) ) { ?>
					<?php echo get_avatar( $comment, 40 ); ?>
				<?php } else { ?>
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/avatar.png"/>
				<?php } ?>
			</div>
			<div class="comment__meta">
				<?php if ( $comment->comment_approved == '0' ): ?>
					<p><?php echo esc_html_e( 'Your comment awaiting Admin moderation.', 'beritaxx' ) ?></p>
					<br/>
				<?php endif; ?>
				<div class="comment__author">
				    <span><?php echo get_comment_author_link(); ?></span><br/><em><?php echo esc_html( the_time() ); ?></em>
				</div>
				<?php comment_text() ?>
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
			</div>
		</div>
    <?php
}

/**
 * Breadcrumb.
 */
require get_template_directory() . '/include/breadcrumb.php';

/**
 * Post After Publish.
 */
function post_publish_after() {
	
	global $post;
	$date = get_post_time('G', true, $post);
	
	$chunks = array(
		array( 60 * 60 * 24 * 365 , __( 'year', 'beritaxx' ), __( 'year', 'beritaxx' ) ),
		array( 60 * 60 * 24 * 30 , __( 'month', 'beritaxx' ), __( 'month', 'beritaxx' ) ),
		array( 60 * 60 * 24 * 7, __( 'week', 'beritaxx' ), __( 'week', 'beritaxx' ) ),
		array( 60 * 60 * 24 , __( 'day', 'beritaxx' ), __( 'day', 'beritaxx' ) ),
		array( 60 * 60 , __( 'hour', 'beritaxx' ), __( 'hour', 'beritaxx' ) ),
		array( 60 , __( 'minute', 'beritaxx' ), __( 'minute', 'beritaxx' ) ),
		array( 1, __( 'second', 'beritaxx' ), __( 'second', 'beritaxx' ) )
	);

	if ( !is_numeric( $date ) ) {
		$time_chunks = explode( ':', str_replace( ' ', ':', $date ) );
		$date_chunks = explode( '-', str_replace( ' ', '-', $date ) );
		$date = gmmktime( (int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0] );
	}
	
	$current_time = current_time( 'mysql', $gmt = 7 ); // waktu Indonesia GMT + 7
	$newer_date = strtotime( $current_time );

	$since = $newer_date - $date;

	if ( 0 > $since )
		return __( '', 'beritaxx' );

	for ( $i = 0, $j = count($chunks); $i < $j; $i++) {
		$seconds = $chunks[$i][0];

		if ( ( $count = floor($since / $seconds) ) != 0 )
			break;
	}

	$output = ( 1 == $count ) ? '1 '. $chunks[$i][1] : $count . ' ' . $chunks[$i][2];
	
	if ( !(int)trim($output) ){
		$output = '0 ' . __( 'second', 'beritaxx' );
	}
	
	$output .= __('&nbsp;ago', 'beritaxx');
	
	return $output;
}

add_filter('the_time', 'post_publish_after');

function post_get_publish_after() {
	
	global $post;
	$date = get_post_time('G', true, $post);
	
	$chunks = array(
		array( 60 * 60 * 24 * 365 , __( 'year', 'beritaxx' ), __( 'year', 'beritaxx' ) ),
		array( 60 * 60 * 24 * 30 , __( 'month', 'beritaxx' ), __( 'month', 'beritaxx' ) ),
		array( 60 * 60 * 24 * 7, __( 'week', 'beritaxx' ), __( 'week', 'beritaxx' ) ),
		array( 60 * 60 * 24 , __( 'day', 'beritaxx' ), __( 'day', 'beritaxx' ) ),
		array( 60 * 60 , __( 'hour', 'beritaxx' ), __( 'hour', 'beritaxx' ) ),
		array( 60 , __( 'minute', 'beritaxx' ), __( 'minute', 'beritaxx' ) ),
		array( 1, __( 'second', 'beritaxx' ), __( 'second', 'beritaxx' ) )
	);

	if ( !is_numeric( $date ) ) {
		$time_chunks = explode( ':', str_replace( ' ', ':', $date ) );
		$date_chunks = explode( '-', str_replace( ' ', '-', $date ) );
		$date = gmmktime( (int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0] );
	}
	
	$current_time = current_time( 'mysql', $gmt = 7 ); // waktu Indonesia GMT + 7
	$newer_date = strtotime( $current_time );

	$since = $newer_date - $date;

	if ( 0 > $since )
		return __( 'a', 'beritaxx' );

	for ( $i = 0, $j = count($chunks); $i < $j; $i++) {
		$seconds = $chunks[$i][0];

		if ( ( $count = floor($since / $seconds) ) != 0 )
			break;
	}

	$output = ( 1 == $count ) ? '1 '. $chunks[$i][1] : $count . ' ' . $chunks[$i][2];
	
	if ( !(int)trim($output) ){
		$output = '0 ' . __( 'second', 'beritaxx' );
	}
	
	$output .= __('&nbsp;ago', 'beritaxx');
	
	return $output;
}

add_filter('get_the_time', 'post_get_publish_after');

/**
 * Comment
 */
function getPostComments($postID){
    $query_post = get_post($postID);
    $num = $query_post->comment_count;
 
    return $num;
}

/**
 * Remove Lazy Load
 */
function my_no_loading_filter( $attr, $attachment, $size ) {
  unset( $attr['loading'] );
  return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'my_no_loading_filter', 10, 3 );



function beritaxx_stylescripts() {
	$theme_version = wp_get_theme()->get( 'Version' );
	$refresh = date_i18n("His");
	wp_enqueue_style('beritaxx-style', get_stylesheet_uri(), array(), $refresh );
	wp_enqueue_style('beritaxx-owl', get_template_directory_uri().'/css/owl.carousel.min.css', array(), $theme_version );
	wp_enqueue_style('beritaxx-ani', get_template_directory_uri().'/css/owl.animate.css', array(), $theme_version );
	wp_enqueue_style('beritaxx-theme', get_template_directory_uri().'/css/owl.theme.default.min.css', array(), $theme_version );
	wp_enqueue_style('beritaxx-awe', get_template_directory_uri().'/fontawesome/css/all.min.css', array(), $theme_version );
	wp_enqueue_style('wp-block-library' );
	
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
	
	wp_enqueue_script( 'beritaxx-owls', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), false, true );
	
}
add_action('wp_enqueue_scripts', 'beritaxx_stylescripts');

function web_scripts() {
	
	$body_font = esc_html(get_theme_mod('beritaxxfont_global'));
	$headings_font = esc_html(get_theme_mod('beritaxxfont_heading'));

	if( $headings_font ) {
		wp_enqueue_style( 'web-headings-fonts', '//fonts.googleapis.com/css?family='. $headings_font . '&display=swap' );
	} else {
		wp_enqueue_style( 'web-roboto', '//fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic');
	}
	if( $body_font ) {
		wp_enqueue_style( 'web-body-fonts', '//fonts.googleapis.com/css?family='. $body_font . '&display=swap' );
	} else {
		wp_enqueue_style( 'web-roboto', '//fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic');
	}
}
add_action( 'wp_enqueue_scripts', 'web_scripts' );

function admin_customizercss() {
        wp_register_style( 'customizer_css', get_template_directory_uri() . '/css/customizer.css', false, '1.0.0' );
        wp_enqueue_style( 'customizer_css' );
}
add_action( 'admin_enqueue_scripts', 'admin_customizercss' );

function beritaxx_headscript() {
    wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'dark', get_template_directory_uri() . '/js/dark-mode.js', array(), '1.0.0', true );
	wp_enqueue_script( 'toggle', get_template_directory_uri() . '/js/toggle-class.js', array(), '1.0.0', true );
}
add_action('wp_enqueue_scripts', 'beritaxx_headscript');

function taxx_customize_preview_js() {
	wp_enqueue_script( 'taxx-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20141216', true );
}
add_action( 'customize_preview_init', 'taxx_customize_preview_js' );

/**
 * Widget
 */
function beritaxxx_widgets_init() {

    require get_template_directory().'/widgets/latest-sidebar.php';
	register_widget('LatestSidebar');
	require get_template_directory().'/widgets/full-block-one.php';
	register_widget('FullBlock1');
	
    register_sidebar(array(
		'name'          => __('Sidebar', 'beritaxx'),
		'id'            => 'sidebar',
		'before_widget' => '<div id="%1$s" class="%2$s widget_block">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>'
	));
	
	register_sidebar(array(
		'name'          => __('Home Full Width', 'beritaxx'),
		'id'            => 'widget-home',
		'before_widget' => '<div id="%1$s" class="%2$s widget_block">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>'
	));
	
}
add_action('widgets_init', 'beritaxxx_widgets_init');


function related_post_code( $atts ) {
    extract( shortcode_atts( array(
    	'number'      => 1,
		'read_related'    => '<div class="read_related">',
		'related_title'   => __( '<div class="related_title">Read Also</div>', 'beritaxx' ),
		'related_content' => '<div class="related_content">',
		'openul'	  => '<ul>',
		'id'          => get_the_ID(),
    ), $atts ) );
	
	$post_id = get_the_ID();
    $cat_ids = array();
    $categories = get_the_category( $post_id );

    if(!empty($categories) && !is_wp_error($categories)):
        foreach ($categories as $category):
            array_push($cat_ids, $category->term_id);
        endforeach;
    endif;
	
	$return_string = '';
	$return_string .= ''.$read_related;
	$the_query = new WP_Query( array(
    	'category__in' => $cat_ids, 
		'orderby'      => 'rand', 
		'order'        => 'DESC' , 
		'showposts'    => $number , 
		'post__not_in' => array( $id ), 
	));
	
	if ( $the_query->have_posts() ) { 
    	while ( $the_query->have_posts() ) { $the_query->the_post();
		    global $post;
			if ( empty( $display_name ) ) {
				$display_name     = get_the_author_meta( 'display_name', $post->post_author );
			} else {
				$display_name     = get_the_author_meta( 'nickname', $post->post_author );
			}
		    $return_string .= $related_title;
	    	$return_string .= '<div class="related_inline taxx_clear">';
			$return_string .= get_the_post_thumbnail(get_the_ID(),'small');
			$return_string .= '<div class="related_right">';
			$return_string .= '<div class="time_mini">' . get_the_time() . '</div>';
			$return_string .= '<strong><a target="_blank" href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></strong></div>';
            $return_string .= '<div class="list_after"><span class="com_mini"><i class="far fa-eye"></i> ';
			$return_string .= getViews(get_the_ID()) . '</span><span class="user_mini"><i class="far fa-user-circle"></i> ';
			$return_string .= $display_name . '</span></div>';
			$return_string .= '</div>';
		} 
    } else {
        $return_string .= '';
	}
	
	wp_reset_postdata();
	
	$return_string .= '</div>';
	
	return $return_string;
}
add_shortcode( 'inlinerelated', 'related_post_code' );


add_filter('the_content', 'beritaxx_inline_related_post');
function beritaxx_inline_related_post($content)
{	if(is_singular('post')){
		$content_block = explode('<p>',$content);
		if( !empty( $content_block[2] ) ) {	
	    	$content_block[2] .= do_shortcode('[inlinerelated]');
		}
		if( !empty( $content_block[5] ) ) {	
	    	$content_block[5] .= do_shortcode('[inlinerelated]');
		}
		for( $i=1; $i<count($content_block); $i++ ) {	
	    	$content_block[$i] = '<p>'.$content_block[$i];
		}
		$content = implode('',$content_block);
	}
	return $content;	
}

add_filter('the_content', 'beritaxx_inline_ads');
function beritaxx_inline_ads($content)
{	if(is_singular('post')){
		$content_ads = explode('</p>',$content);
		if( !empty( $content_ads[0] ) ) {	
	    	$content_ads[0] .= '<div class="inline_ads">' . html_entity_decode( get_theme_mod( 'inline_ads_one' ) ) . '</div>';
		}
		if( !empty( $content_ads[3] ) ) {	
	    	$content_ads[3] .= '<div class="inline_ads">' . html_entity_decode( get_theme_mod( 'inline_ads_two' ) ) . '</div>';
		}
		for( $i=1; $i<count($content_ads); $i++ ) {	
	    	$content_ads[$i] = '</p>'.$content_ads[$i];
		}
		$content = implode('',$content_ads);
	}
	return $content;	
}

	// 5. Metabox Video
    add_action('admin_init', 'beritaxx_video_post', 1);
	
	// tambah metabox
	function beritaxx_video_post() {
	    add_meta_box('beritaxx_video_embed', 'Embed Video', 'beritaxx_video_embed', 'post', 'normal', 'high');
	}
	
	// tambah kolom
	function beritaxx_video_embed() {
	    global $post;
	    echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
	    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	    $taxx_embed = get_post_meta($post->ID, 'taxx_embed', true);

		echo '<div class="clear">';
	    echo '<input type="text" name="taxx_embed" value="' . $taxx_embed  . '" class="widefat" /><br/><br/>';
		echo 'KETERANGAN : Tambahkan link video dari Youtube, Vimeo, dll';
    	echo '</div>';
	}
	
	// save inputan
	function beritaxx_video_embed_meta($post_id, $post) {
	    if ( ! isset( $_POST['eventmeta_noncename'] ) || !wp_verify_nonce( $_POST['eventmeta_noncename'], plugin_basename(__FILE__) )) {
	    return $post->ID;
	    }

	    if ( !current_user_can( 'edit_post', $post->ID ))
	        return $post->ID;
		
		$events_meta['taxx_embed'] = isset($_POST['taxx_embed']) ? $_POST['taxx_embed'] : '';

	    foreach ($events_meta as $key => $value) {      
		    if( $post->post_type == 'revision' ) return;
	        $value = implode(',', (array)$value); 
	        if(get_post_meta($post->ID, $key, FALSE)) { 
	            update_post_meta($post->ID, $key, $value);
	        } else { 
	            add_post_meta($post->ID, $key, $value);
	        }
	        if(!$value) delete_post_meta($post->ID, $key); 
	    }

	}
	add_action('save_post', 'beritaxx_video_embed_meta', 1, 2); 