<?php 
/**
 * Plugin Name: Ready Login Windows
 * Plugin URI: http://www.najeebmedia.com/
 * Description: Choose beautiful designs for login window and also change logo with graphics or text even disable logo 
 * Version: 1.0
 * Author: N-Media
 * Author URI: http://www.najeebmedia.com/
 * Text Domain: wp-login-window
 * License: GPL2
 */
 
 
 /*  Copyright 2014  N-Media  (email : sales@najeebmedia.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
 
 
/*
 * loading plugin config file
 */
$_config = plugin_dir_path( __FILE__ ) . 'config.php';
if( file_exists($_config))
	include_once($_config);
else
	die('Reen, Reen, BUMP! not found '.$_config);


/* ======= the plugin main class =========== */
$_plugin = plugin_dir_path( __FILE__ ) . 'classes/plugin.class.php';
if( file_exists($_plugin))
	include_once($_plugin);
else
	die('Reen, Reen, BUMP! not found '.$_plugin);

/*
 * [1]
 * TODO: just replace class name with your plugin
 */
 
$nm_logins = NM_Login::get_instance();
NM_Login::init();

if( is_admin() ){

	$_admin = dirname(__FILE__).'/classes/admin.class.php';
	if( file_exists($_admin))
		include_once($_admin );
	else
		die('file not found! '.$_admin);

	$nm_logins_admin = new NM_Login_Admin();
}

/*
 * activation/install the plugin data
*/
register_activation_hook( __FILE__, array('NM_Login', 'activate_plugin'));
register_deactivation_hook( __FILE__, array('NM_Login', 'deactivate_plugin'));

/**
 * delete options, tables or anything else
 */
 if(defined('WP_UNINSTALL_PLUGIN') ){
 
  //delete options, tables or anything else
   
}


