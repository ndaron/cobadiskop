<?php
/*
 * this is main plugin class
*/


/* ======= the model main class =========== */
if(!class_exists('NM_Framwork_V2_nm_logins')){
	$_framework = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'nm-framework.php';
	if( file_exists($_framework))
		include_once($_framework);
	else
		die('Reen, Reen, BUMP! not found '.$_framework);
}


/*
 * [1]
 * TODO: change the class name of your plugin
 */
class NM_Login extends NM_Framwork_V2_nm_logins{

	private static $ins = null;
	
	public static function init()
	{
		add_action('plugins_loaded', array(self::get_instance(), '_setup'));
	}
	
	public static function get_instance()
	{
		// create a new object if it doesn't exist.
		is_null(self::$ins) && self::$ins = new self;
		return self::$ins;
	}
	
	
	function _setup(){
		
		//setting plugin meta saved in config.php
		$this -> plugin_meta = get_plugin_meta_nm_logins();

		//getting saved settings
		$this -> plugin_settings = get_option ( $this -> plugin_meta['shortname'] . '_settings' );
		
		
		// populating $inputs with NM_Inputs object
		$this->inputs = $this->get_all_inputs ();
		
		/*
		 * [2]
		 * TODO: update scripts array for SHIPPED scripts
		 * only use handlers
		 */
		//setting shipped scripts
		$this -> wp_shipped_scripts = array('jquery');
		
		
		/*
		 * [3]
		* TODO: update scripts array for custom scripts/styles
		*/
		//setting plugin settings
		$this -> plugin_scripts =  array(array(	'script_name'	=> 'scripts',
												'script_source'	=> '/js/script.js',
												'localized'		=> true,
												'type'			=> 'js',
												'depends'		=> array('jquery'),
												'in_footer'		=> false,
												'version'		=> false,
										),
												array(	'script_name'	=> 'styles',
														'script_source'	=> '/plugin.styles.css',
														'localized'		=> false,
														'type'			=> 'style',
														'in_footer'		=> false,
														'version'		=> false,
												),
										);
		
		/*
		 * [4]
		* TODO: localized array that will be used in JS files
		* Localized object will always be your pluginshortname_vars
		* e.g: pluginshortname_vars.ajaxurl
		*/
		$this -> localized_vars = array();
		
		
		/*
		 * [5]
		 * TODO: this array will grow as plugin grow
		 * all functions which need to be called back MUST be in this array
		 * setting callbacks
		 * Updated V2: September 16, 2014
		 * Now truee/false against each function
		 * true: logged in
		 * false: visitor + logged in
		 */
		 
		//following array are functions name and ajax callback handlers
		$this -> ajax_callbacks = array('none'	=> true);	//do not change this action, is for admin
										
		
		/*
		 * plugin localization being initiated here
		 */
		add_action('init', array($this, 'wpp_textdomain'));
		
		
		
		/*
		 * hooking up scripts for front-end
		*/
		//add_action('wp_enqueue_scripts', array($this, 'load_scripts'));

		/*
		 * Changing Skins
		*/
		add_action('login_enqueue_scripts', array($this, 'nm_login_skins'));


		/*
		 * Changing Login Logo
		*/
		add_action('login_enqueue_scripts', array($this, 'login_window_logo'));
		add_filter( 'login_headerurl', array($this,'nm_login_logo_url'));
		add_filter( 'login_headertitle', array($this,'nm_login_logo_title'));

		/*
		 * registering callbacks
		*/
		$this -> do_callbacks();

	}
	

	/*
	* Changing Bg color
	*/
	function nm_login_skins(){

		$selected_screen = $this -> plugin_settings['login_screen'];
		if($selected_screen==true) {
			wp_enqueue_style('nm-login', $this -> plugin_meta['url'] ."styles/{$selected_screen}.css");
		}

	}	

	function login_window_logo(){
		$logopath = $this -> get_option('_custom_logo');
		$disablelogo = $this -> get_option('_hide_logo');
		if($disablelogo == 'yes') {
			echo '<style type="text/css">';
			echo 'body.login div#login h1 {
	            display: none; !important;}';

            echo '</style>';

		}
		else {

			echo '<style type="text/css">';

    		echo "h1 a { background-image:url('$logopath') !important;
    				background-size: 100% !important;
    				width: 100% !important;}";

    		echo "</style>";			
		}
	}
	
	function nm_login_logo_url()
	{
		return home_url();
	}

	function nm_login_logo_title()
	{
		$sitename = get_bloginfo('name');
		return 'Go to '.$sitename;
	}

	function get_plugin_settings(){
		
		$temp_settings = array();
		foreach($this -> plugin_setting_tabs as $tab){
			
			$temp_settings[$tab] = get_option( $tab . '_settings' );
		}
		
		$this -> pa($temp_settings);
		
		return $temp_settings;
	}
	
	
	/*
	 * =============== NOW do your JOB ===========================
	 * 	
	 */
		
	
	
	



	// ================================ SOME HELPER FUNCTIONS =========================================

	
	

	function activate_plugin(){

		
		
		/*
		 * NOTE: $plugin_meta is not object of this class, it is constant 
		 * defined in config.php
		 */
			
		/* global $wpdb,$plugin_meta;
		
		$sql = "";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		add_option("nm_plugin_db_version", $plugin_meta['db_version']); */

	}

	function deactivate_plugin(){

		//do nothing so far.
	}
	
	/*
	 * returning NM_Inputs object
	*/
	function get_all_inputs() {
		if (! class_exists ( 'NM_Inputs_nm_logins' )) {
			$_inputs = dirname ( __FILE__ ) . DIRECTORY_SEPARATOR . 'input.class.php';
			if (file_exists ( $_inputs ))
				include_once ($_inputs);
			else
				die ( 'Reen, Reen, BUMP! not found ' . $_inputs );
		}
	
		$nm_inputs = new NM_Inputs_nm_logins ();
		// webcontact_pa($this->plugin_meta);
	
		// registering all inputs here
	
		return array (
	
				'text' 		=> $nm_inputs->get_input ( 'text' ),
				'number' 	=> $nm_inputs->get_input ( 'number' ),
				'textarea' 	=> $nm_inputs->get_input ( 'textarea' ),
				'masked' 	=> $nm_inputs->get_input ( 'masked' ),
				'hidden' 	=> $nm_inputs->get_input ( 'hidden' ),
				'autocomplete' 	=> $nm_inputs->get_input ( 'autocomplete' ),
				'email' 	=> $nm_inputs->get_input ( 'email' ),
				'date' 		=> $nm_inputs->get_input ( 'date' ),
				'color' 	=> $nm_inputs->get_input ( 'color' ),
				'select' 	=> $nm_inputs->get_input ( 'select' ),
				'radio' 	=> $nm_inputs->get_input ( 'radio' ),
				'checkbox' 	=> $nm_inputs->get_input ( 'checkbox' ),
				'countries'	=> $nm_inputs->get_input ( 'countries' ),
				'file' 		=> $nm_inputs->get_input ( 'file' ),
				'image' 	=> $nm_inputs->get_input ( 'image' ),
				'section' 	=> $nm_inputs->get_input ( 'section' ),
	
		);
	
		// return new NM_Inputs($this->plugin_meta);
	}
}