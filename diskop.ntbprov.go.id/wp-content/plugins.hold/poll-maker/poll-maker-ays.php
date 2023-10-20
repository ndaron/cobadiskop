<?php
ob_start();
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://ays-pro.com/
 * @since             1.0.0
 * @package           Poll_Maker_Ays
 *
 * @wordpress-plugin
 * Plugin Name:       Poll Maker
 * Plugin URI:        https://ays-pro.com/index.php/wordpress/poll-maker/
 * Description:       This is a simple polls maker.
 * Version:           3.1.9
 * Author:            Poll Maker Team
 * Author URI:        https://ays-pro.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       poll-maker-ays
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('POLL_MAKER_AYS_VERSION', '3.1.9');
define('POLL_MAKER_AYS_NAME', 'poll-maker-ays');

if (!defined('POLL_MAKER_AYS_DIR')) {
	define('POLL_MAKER_AYS_DIR', plugin_dir_path(__FILE__));
}

if (!defined('POLL_MAKER_AYS_BASE_URL')) {
	define('POLL_MAKER_AYS_BASE_URL', plugin_dir_url(__FILE__));
}
if (!defined('POLL_MAKER_AYS_ADMIN_URL')) {
	define('POLL_MAKER_AYS_ADMIN_URL', plugin_dir_url(__FILE__) . 'admin');
}

if (!defined('POLL_MAKER_AYS_PUBLIC_URL')) {
	define('POLL_MAKER_AYS_PUBLIC_URL', plugin_dir_url(__FILE__) . 'public');
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-poll-maker-ays-activator.php
 */
function activate_poll_maker_ays() {
	require_once plugin_dir_path(__FILE__) . 'includes/class-poll-maker-ays-activator.php';
	Poll_Maker_Ays_Activator::ays_poll_update_db_check();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-poll-maker-ays-deactivator.php
 */
function deactivate_poll_maker_ays() {
	require_once plugin_dir_path(__FILE__) . 'includes/class-poll-maker-ays-deactivator.php';
	Poll_Maker_Ays_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_poll_maker_ays');
register_deactivation_hook(__FILE__, 'deactivate_poll_maker_ays');

add_action('plugins_loaded', 'activate_poll_maker_ays');
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-poll-maker-ays.php';

/**
 * The Gutenberg block registration.
 */
require plugin_dir_path(__FILE__) . 'poll/poll-maker-block.php';


if (!function_exists('array_column')) {
	function array_column( array $array, $columnKey, $indexKey = null ) {
		$result = array();
		foreach ( $array as $subArray ) {
			if (!is_array($subArray)) {
				continue;
			} elseif (is_null($indexKey) && array_key_exists($columnKey, $subArray)) {
				$result[] = $subArray[$columnKey];
			} elseif (array_key_exists($indexKey, $subArray)) {
				if (is_null($columnKey)) {
					$result[$subArray[$indexKey]] = $subArray;
				} elseif (array_key_exists($columnKey, $subArray)) {
					$result[$subArray[$indexKey]] = $subArray[$columnKey];
				}
			}
		}

		return $result;
	}
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_poll_maker_ays() {
    add_action( 'activated_plugin', 'poll_maker_activation_redirect_method' );
	add_action('admin_notices', 'poll_maker_admin_notice');
	$plugin = new Poll_Maker_Ays();
	$plugin->run();

}

function poll_maker_activation_redirect_method( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
        exit( wp_redirect( admin_url( 'admin.php?page=' . POLL_MAKER_AYS_NAME ) ) );
    }
}

function poll_maker_admin_notice() {
	if (isset($_GET['page']) && strpos($_GET['page'], POLL_MAKER_AYS_NAME) !== false) {
		?>
        <div class="ays-notice-banner">
            <div class="navigation-bar">
                <div id="navigation-container">
                    <a class="logo-container" href="http://ays-pro.com/" target="_blank">
                        <img class="logo" src="<?php echo POLL_MAKER_AYS_ADMIN_URL . '/images/ays_pro.png'; ?>"
                             alt="AYS Pro logo"
                             title="AYS Pro logo"/>
                    </a>
                    <ul id="menu">
                        <li class="modile-ddmenu-xss"><a class="ays-btn" href="https://ays-pro.com/index.php/wordpress/poll-maker/" target="_blank">PRO</a></li>
                            <li class="modile-ddmenu-lg"><a class="ays-btn"  href="https://ays-pro.com/wordpress-poll-maker-user-manual" target="_blank">Documentation</a></li>
                            <li class="modile-ddmenu-xs"><a class="ays-btn" href="https://wordpress.org/support/plugin/poll-maker/reviews/" target="_blank">Rate us</a></li>
                            <li class="modile-ddmenu-lg"><a class="ays-btn" href="https://poll-plugin.com/wordpress-poll-plugin-free-demo/" target="_blank">Demo</a></li>
                            <li class="modile-ddmenu-lg"><a class="ays-btn" href="https://wordpress.org/support/plugin/poll-maker/" target="_blank">Free Support</a></li>
                            <li class="modile-ddmenu-xs make_a_suggestion"><a class="ays-btn" href="https://ays-demo.com/poll-maker-plugin-survey/" target="_blank">Make a Suggestion</a></li>
                            <li class="modile-ddmenu-lg"><a class="ays-btn" href="https://wordpress.org/support/plugin/poll-maker/" target="_blank">Contact us</a></li>
                            <li class="modile-ddmenu-md">
                                <a class="toggle_ddmenu" href="javascript:void(0);"><i class="ays_poll_fa ays_fa_ellipsis_h"></i></a>
                                <ul class="ddmenu" data-expanded="false">
                                    <li><a class="ays-btn" href="https://ays-pro.com/wordpress-poll-maker-user-manual" target="_blank">Documentation</a></li>
                                    <li><a class="ays-btn" href="https://poll-plugin.com/wordpress-poll-plugin-free-demo/" target="_blank">Demo</a></li>
                                   <li><a class="ays-btn" href="https://wordpress.org/support/plugin/poll-maker/" target="_blank">Free Support</a></li>
                                    <li><a class="ays-btn" href="https://wordpress.org/support/plugin/poll-maker/" target="_blank">Contact us</a></li>
                                </ul>
                            </li>
                            <li class="modile-ddmenu-sm">
                            <a class="toggle_ddmenu" href="javascript:void(0);"><i class="ays_poll_fa ays_fa_ellipsis_h"></i></a>
                            <ul class="ddmenu" data-expanded="false">
                                <li><a class="ays-btn" href="https://ays-pro.com/wordpress-poll-maker-user-manual" target="_blank">Documentation</a></li>
                                <li><a class="ays-btn" href="https://wordpress.org/support/plugin/poll-maker/reviews/" target="_blank">Rate us</a></li>
                                <li><a class="ays-btn" href="https://poll-plugin.com/wordpress-poll-plugin-free-demo/" target="_blank">Demo</a></li>
                                <li><a class="ays-btn" href="https://wordpress.org/support/plugin/poll-maker/" target="_blank">Free Support</a></li>
                                <li class="make_a_suggestion"><a class="ays-btn" href="https://ays-demo.com/poll-maker-plugin-survey/" target="_blank">Make a Suggestion</a></li>
                                <li><a class="ays-btn" href="https://wordpress.org/support/plugin/poll-maker/" target="_blank">Contact us</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

		<div class="ays_ask_question_content">
			<div class="ays_ask_question_content_inner">
				<a href="https://wordpress.org/support/plugin/poll-maker" class="ays_poll_queztion_link" target="_blank">Ask a question</a>
				<img src="<?php echo POLL_MAKER_AYS_ADMIN_URL.'/images/icons/pngegg110.png'?>">
			</div>
		</div>

		<!--
			// if(isset($_POST['ays_poll_sale_btn'])){
			// 	update_option('ays_poll_sale_notification', 1); 
			// 	update_option('ays_poll_sale_date', current_time( 'mysql' ));
			// }

			// $ays_poll_sale_date = get_option('ays_poll_sale_date');
			// $current_date = current_time( 'mysql' );
			// $date_diff = strtotime($current_date) -  intval(strtotime($ays_poll_sale_date)) ;
			// $val = 60*60*24*5;
			// $days_diff = $date_diff / $val;

			// if(intval($days_diff) > 0 ){
			// 	update_option('ays_poll_sale_notification', 0); 
			// }

			// $ays_poll_flag = intval(get_option('ays_poll_sale_notification'));
			
			// if($ays_poll_flag == 0 ){
			// 	ays_poll_sale_message($ays_poll_flag);
			// }
		-->
<?php
	}
}

// function ays_poll_sale_message($flag){
//         if($flag == 0){
// 			<!--<div class="notice notice-success is-dismissible ays_poll_dicount_info" style="background-color: #7984eb29; border-color:#007cba;">
// 				<div id="ays_poll_dicount_banner" class="ays_poll_dicount_month" style="display: flex;align-items: center;justify-content: space-between;">
// 					<div style="display: flex; align-items: center;">
// 						<div>
// 							<a href="https://ays-pro.com/wordpress/poll-maker" target="_blank" class="ays-poll-sale-banner-link"><img src="<?php echo POLL_MAKER_AYS_ADMIN_URL . '/images/sale.png'; " style="width: 60px;"></a>
// 						</div>
// 						<div style="font-size:14px; padding-left: 12px;">
// 							<strong>
// 								<#?php echo __( "Limited Time <span style='color:red;'>30%</span> SALE on Pro plans!",POLL_MAKER_AYS_NAME);  
// 							</strong>
// 							<br>
// 							<strong style="font-size: 12px;">								
// 									<#?php echo __( "Spring is the season of a new beginning! Start it right with all the powerful tools you need for creating an advanced interactive website. Hurry! Ends on April 30. <a href='https://ays-pro.com/wordpress/poll-maker' target='_blank'>DON'T MISS OUT!</a>",POLL_MAKER_AYS_NAME);							
// 							</strong>							
// 							<form action="" method="POST">
// 								<button class="btn btn-link ays-button" name="ays_poll_sale_btn" style="height: 32px; margin-left: 0;padding-left: 0">Dismiss ad</button>
// 							</form>
// 						</div>
// 					</div>
// 					<a href="https://ays-pro.com/wordpress/poll-maker" class="button button-primary ays-button" id="ays-button-top-buy-now" target="_blank" style="height: 32px; display: flex; align-items: center; font-weight: 500; " ><?php echo __('Buy Now !',POLL_MAKER_AYS_NAME); </a>
				
// 				</div>
				
// 			</div>		-->	
// 			<?php
// 		}
// }

run_poll_maker_ays();