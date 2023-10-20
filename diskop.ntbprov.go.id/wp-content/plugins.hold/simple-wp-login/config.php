<?php
/*
 * this file contains pluing meta information and then shared
 * between pluging and admin classes
 * 
 */

/*
 * TODO: change the function name
*/

$plugin_meta = array();
function get_plugin_meta_nm_logins(){
	
	$plugin_meta = array('name'				=> 'WP Login',
							'shortname'		=> 'nm_logins',
							'path'			=> plugin_dir_path( __FILE__ ),
							'url'			=> plugin_dir_url( __FILE__ ),
							'plugin_version'=> 1.0,
							'logo'			=> plugin_dir_url( __FILE__ ) . 'images/logo.png',);
	
	//print_r($plugin_meta);
	
	return $plugin_meta;
}


/**
 * printing the formatted array
 */
 function pa_nm_logins( $arr ){
 	
	echo '<pre>';
		print_r( $arr );
	echo '</pre>';
 }
 

