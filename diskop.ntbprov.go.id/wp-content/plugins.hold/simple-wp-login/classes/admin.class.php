<?php
/*
 * working behind the seen
*/


class NM_Login_Admin extends NM_Login{


	var $menu_pages, $plugin_scripts_admin, $plugin_settings;


	function __construct(){


		//setting plugin meta saved in config.php
		$this -> plugin_meta = get_plugin_meta_nm_logins();

		//getting saved settings
		$this -> plugin_settings = get_option($this->plugin_meta['shortname'].'_settings');


		/*
		 * [1]
		* TODO: change this for plugin admin pages
		*/
		$this -> menu_pages		= array(
				array(
						'page_title'	=> $this->plugin_meta['name'],
										'menu_title'	=> $this->plugin_meta['name'],
										'cap'			=> 'manage_options',
										'slug'			=> $this->plugin_meta['shortname'],
										'callback'		=> 'nm_settings',
										'parent_slug'		=> 'options-general.php',),
		);


		/*
		 * [2]
		* TODO: Change this for admin related scripts
		* JS scripts and styles to loaded
		* ADMIN
		*/
		$this -> plugin_scripts_admin =  array(
		
				array(	'script_name'	=> 'scripts-chosen',
						'script_source'	=> 'js/chosen/chosen.jquery.min.js',
						'localized'		=> false,
						'type'			=> 'js',
						'page_slug'		=> $this->plugin_meta['shortname'],
						'depends' => array ('jquery')
					),
				
				array (
						'script_name' => 'chosen-style',
						'script_source' => 'js/chosen/chosen.min.css',
						'localized' => false,
						'type' => 'style',
						'page_slug' => $this->plugin_meta['shortname'],
				),
				
				
				array(	'script_name'	=> 'scripts-admin',
						'script_source'	=> 'js/admin.js',
						'localized'		=> true,
						'type'			=> 'js',
						'page_slug'		=> $this->plugin_meta['shortname'],
						'depends' => array (
								'jquery',
								'jquery-ui-tabs',
								'wp-color-picker',
								//'media-upload',
								//'thickbox'
						),
						'in_footer'	=> true,
				),
				
				
				array (
						'script_name' => 'ui-style',
						'script_source' => 'js/ui/css/smoothness/jquery-ui-1.10.3.custom.min.css',
						'localized' => false,
						'type' => 'style',
						'page_slug' => $this->plugin_meta['shortname'],
				),
				array (
						'script_name' => 'thickbox',
						'script_source' => 'shipped',
						'localized' => false,
						'type' => 'style',
						'page_slug' => $this->plugin_meta['shortname'],
				),
				
				array (
						'script_name' => 'wp-color-picker',
						'script_source' => 'shipped',
						'localized' => false,
						'type' => 'style',
						'page_slug' => array (
								$this->plugin_meta ['shortname'],
						)
				),
				
				
		);
		
		$this -> ajax_callbacks = array('save_settings'	=> true);		//do not change this action, is for admin
										


		add_action('admin_menu', array($this, 'add_menu_pages'));
		
		/**
		 * laoding admin scripts only for plugin pages
		 * since 27 september, 2014
		 * Najeeb's 
		 */
		add_action( 'admin_enqueue_scripts', array (
						$this,
						'load_scripts_admin'
						));
		
		
		$this -> do_callbacks();
		
	}

	

	
	function load_scripts_admin($hook) {
		
		/**
		 * Note: we mostly hook independant page for our plugins
		 * so it's page hook will be: toplevel_page_PAGE_SLUG
		 */		
		 
		 //var_dump($hook);
		 
		// loading script for only plugin optios pages
		// page_slug is key in $plugin_scripts_admin which determine the page
		
		
		
		foreach ( $this->plugin_scripts_admin as $script ) {
		
			$attach_script = false;
			if (is_array ( $script ['page_slug'] )) {
					
				
				foreach( $script ['page_slug'] as $page){
					/**
					 * its very important var, when menu page is loaded as submenu of current plugin
					 * then it has different hook_suffix
					 */
					$plugin_sublevel = "settings_page_nm_logins";
					$plugin_toplevel = "toplevel_page_".$page;
					
					if ( $hook == $plugin_toplevel || $hook == $plugin_sublevel){
						$attach_script = true;
					}
				}	
			} else {
				/**
					 * its very important var, when menu page is loaded as submenu of current plugin
					 * then it has different hook_suffix
					 */
					$plugin_sublevel = "THE_PLUGIN_HOOK".$script ['page_slug'];
					$plugin_toplevel = "settings_page_".$script ['page_slug'];
					if ( $hook == $plugin_toplevel || $hook == $plugin_sublevel){
						
						$attach_script = true;
					}
			}
				
			//echo 'script page '.$script_pages;
			if( $attach_script ){
				
				// adding media upload scripts (WP 3.5+)
				wp_enqueue_media();
				
				// localized vars in js
				$arrLocalizedVars = array (
						'plugin_url' => $this->plugin_meta ['url'],
						'doing' => $this->plugin_meta ['url'] . '/images/loading.gif',
						'plugin_admin_page' => admin_url ( 'options-general.php?page=nm_logins' )
				);
				
				// checking if it is style
				if ($script ['type'] == 'js') {
					$depends = (isset($script['depends']) ? $script['depends'] : NULL);
					$in_footer = (isset($script['in_footer']) ? $script['in_footer'] : false);
					wp_enqueue_script ( $this->plugin_meta ['shortname'] . '-' . $script ['script_name'], $this->plugin_meta ['url'] . $script ['script_source'], $depends, $this->plugin_meta['plugin_version'], $in_footer );
						
					// if localized
					if ($script ['localized'])
						wp_localize_script ( $this->plugin_meta ['shortname'] . '-' . $script ['script_name'], $this -> plugin_meta['shortname'] . '_vars', $arrLocalizedVars );
				} else {
						
					if ($script ['script_source'] == 'shipped')
						wp_enqueue_style ( $script ['script_name'] );
					else
						wp_enqueue_style ( $this->plugin_meta ['shortname'] . '-' . $script ['script_name'], $this->plugin_meta ['url'] . $script ['script_source'] );
				}
			}
		}
		
	}



	/*
	 * creating menu page for this plugin
	*/

	function add_menu_pages(){

		foreach ($this -> menu_pages as $page){
				
			if ($page['parent_slug'] == ''){

				$menu = add_menu_page(__($page['page_title'], $this->plugin_meta['shortname']),
						__($page['menu_title'], $this->plugin_meta['shortname']),
						$page['cap'],
						$page['slug'],
						array($this, $page['callback']),
						$this->plugin_meta['logo'],
						$this->plugin_meta['menu_position']);
			}else{

				$menu = add_submenu_page($page['parent_slug'],
						__($page['page_title'], $this->plugin_meta['shortname']),
						__($page['menu_title'], $this->plugin_meta['shortname']),
						$page['cap'],
						$page['slug'],
						array($this, $page['callback'])
				);

			}
		
		}
	}


	//====================== CALLBACKS =================================
	
	/*
	 * saving admin setting in wp option data table
	 */
	function save_settings(){
	
		//print_r($_REQUEST); exit;
		
		update_option($this -> plugin_meta['shortname'].'_settings', $_REQUEST);
		_e('All options are updated', 'wp-login-window');
		die(0);
	}
	
	function nm_settings(){

		$this -> load_template('admin/settings.php');
	}
	
	
	
	/* ============== some helper functions =============== */
	function render_settings_input($data) {

		$field_id 	= $data['id'];
		$type 		= $data['type'];
		
		if(!is_array($this ->plugin_settings[ $data['id']]))
			$value		= stripslashes( $this ->plugin_settings[ $data['id']] );
		else 
			$value		= $this ->plugin_settings[ $data['id']];
		
		$options	= (isset($data['options']) ? $data['options'] : '');

		switch($type) {

			case 'text' :
				echo '<input type="text" name="' . $field_id . '" id="' . $field_id . '" value="' . $value . '" class="regular-text">';
				break;
				
			case 'textarea':
				echo '<textarea cols="45" rows="6" name="' . $field_id . '" id="' . $field_id . '" >'.$value.'</textarea>';
				break;
				
			case 'checkbox':
				
				foreach($options as $k => $label){
					
					echo '<label for="'.$field_id.'-'.$k.'">';
					echo '<input type="checkbox" name="' . $field_id . '" id="'.$field_id.'-'.$k.'" value="' . $k . '" '.checked( $value, $k, false).'>';
					printf(__("%s", 'wp-login-window'), $label);
					echo '</label> ';
				}
				
				break;
				
			case 'radio':
			
				foreach($options as $k => $label){
						
					echo '<label for="'.$field_id.'-'.$k.'">';
					echo '<input type="radio" name="' . $field_id . '" id="'.$field_id.'-'.$k.'" value="' . $k . '" '.checked( $value, $k, false).'>';
					printf(__("%s", 'wp-login-window'), $label);
					echo '</label> ';
				}
			
				break;
				
			case 'select':
				
				$default = (isset($data['default']) ? $data['default'] : 'Select option');
				
				echo '<select name="' . $field_id . '" id="' . $field_id . '" class="the_chosen">';
				echo '<option value="">'.$default.'</option>';
				
				foreach($options as $k => $label){
				
					echo '<option value="'.$k.'" '.selected( $value, $k, false).'>'.$label.'</option>';
				}
				
				echo '</select>';
				break;
				
			case 'color' :
				echo '<input type="text" name="' . $field_id . '" id="' . $field_id . '" value="' . $value . '" class="wp-color-field">';
				break;
				
			// =========== some special settings ====================
			
			case 'users':
			
				$default = (isset($data['default']) ? $data['default'] : 'Select option');
				
								
				$args = array(	'blog_id'      => $GLOBALS['blog_id'],
								'orderby'      => 'nicename',
								'order'        => 'ASC',);
				
				$wp_users = get_users($args);
				
				$multiple = ($data['multiselect'] == true ? 'multiple' : '');				
			
				echo '<select name="' . $field_id . '[]" id="' . $field_id . '" class="the_chosen" '.$multiple.'>';
				echo '<option value="">'.$default.'</option>';
			
				foreach($wp_users as $user){
					
					if($value){
						if(in_array($user -> ID, $value))
							$selected = 'selected="selected"';
						else
							$selected = '';
					}
								
					$label = $user -> display_name . ' ('.$user -> user_login.')';
					echo '<option value="'.$user -> ID.'" '.$selected.'>'.$label.'</option>';
				}
			
				echo '</select>';
				break;
				
			case 'categories':
					
				$default = (isset($data['default']) ? $data['default'] : 'Select option');
			
			
				$args = array(	
						'type'                     => 'post',
						'child_of'                 => 0,
						'parent'                   => '',
						'orderby'                  => 'name',
						'order'                    => 'ASC',
						'hide_empty'               => 0,
						'hierarchical'             => 1,);
			
				$wp_cats = get_categories($args);
			
				$multiple = ($data['multiselect'] == true ? 'multiple' : '');
					
				echo '<select name="' . $field_id . '[]" id="' . $field_id . '" class="the_chosen" '.$multiple.'>';
				echo '<option value="">'.$default.'</option>';
					
				foreach($wp_cats as $cat){
						
					if($value){
						if(in_array($cat -> term_id, $value))
							$selected = 'selected="selected"';
						else
							$selected = '';
					}
			
					$label = $cat -> name . ' ('.$cat -> category_nicename.')';
					echo '<option value="'.$cat -> term_id.'" '.$selected.'>'.$label.'</option>';
				}
					
				echo '</select>';
				break;
				
			case 'pages':
				
				
				$default = (isset($data['default']) ? $data['default'] : 'Select option');
					
					
				$args = array(
						'sort_order' => 'ASC',
						'sort_column' => 'post_title',
						'post_type' => 'page',
						'post_status' => 'publish');
					
				$wp_pages = get_pages($args);
					
				$multiple = ($data['multiselect'] == true ? 'multiple' : '');
					
				echo '<select name="' . $field_id . '[]" id="' . $field_id . '" class="the_chosen" '.$multiple.'>';
				echo '<option value="">'.$default.'</option>';
					
				foreach($wp_pages as $page){
			
					if($value){
						if(in_array($page -> ID, $value))
							$selected = 'selected="selected"';
						else
							$selected = '';
					}
						
					$label = $page -> post_title;
					echo '<option value="'.$page -> ID.'" '.$selected.'>'.$label.'</option>';
				}
					
				echo '</select>';
				break;
				
			case 'media' :
				
				if(function_exists('wp_enqueue_media'))
					wp_enqueue_media();
								
				echo '<input type="text" name="' . $field_id . '" id="' . $field_id . '" value="' . $value . '" class="regular-text">';
				echo '<button class="button nm-media-upload">Select</button>';
				echo ' <a href="javascsript:;" class="remove-media"><i class="fa fa-pencil"></i>'.__('Remove', 'wp-login-window').'</a>';
				
				//rendering image thumb
				if($value)
					echo '<br><span class="the-thumb"><img width="75" src="'.$value.'"></span>';
				else
					echo '<br><span class="the-thumb"></span>';
				break;

			case 'file':
				$file = $this->plugin_meta['path'] .'/templates/admin/'.$data['id'];
				if(file_exists($file))
					include $file;
				else
					echo 'file not exists '.$file;
				break;
				
		}
	}

	}
