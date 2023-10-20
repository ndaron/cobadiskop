<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Beritaxx_No_Lite {
    
    const SERVER = 'https://beritaxx.com'; private $id = 'FRVH471Z6X'; private $api; private $host; private $code = ''; private $key; private $data = [];

    /**
     * construction
     *
     */
    public function __construct() {
        $this->api = self::SERVER . '/wp-json/salesloo/v1/file/license';
        $this->host = beritaxx_no_lite_host();
        $this->key = '__newsxx2020';
        $this->data();

        add_action( 'admin_menu', array( $this, 'register_menu' ), 20 );
        add_action( 'admin_init', array( $this, 'on_save_action' ), 10 );
        add_action( 'wp_update_plugins', array( $this, 'periodic_check' ) );
        add_action( 'after_setup_theme', array( $this, 'template_init' ) );
   
    }

    public function template_init() {
        if ( $this->purchase_code ) {
			require get_template_directory() . '/include/template-arcs.php';
		}
    }
    
    public function data() {
        $option = get_option($this->key);
        if (empty($option)) return $this;

        $this->data = json_decode(beritaxx_pro_library_decrypt($option), true);

        return $this;
    }

    /**
     * getter
     * @param  string $name
     * @return mixed
     */
    public function __get($name)
    {
        $value = NULL;

        if (array_key_exists($name, (array)$this->data))
            $value = maybe_unserialize($this->data[$name]);

        return $name == 'status' ? intval($value) : $value;
    }

    /**
     * update_option
     *
     * @param  mixed $result
     * @return void
     */
    private function update_option($result)
    {
        wp_cache_delete($this->key, 'options');
        update_option($this->key, beritaxx_pro_library_encrypt(json_encode($result)));
    }

    /**
     * Register Menu
     * 
     * register manage current menu
     */
	 
    public function register_menu()
    {   
        add_menu_page(
            __( 'Beritaxx License', 'beritaxx' ),
            __( 'Beritaxx Pro', 'beritaxx' ),
            'manage_options',
            'beritaxx_pro-lisensi',
            array( $this, 'page' ),
            'dashicons-admin-network',
            '2'
        );
    }

    /**
     * show menu page
     */
    public function page() {
		$my_theme = wp_get_theme();
		?>
	    
    		<div class="wrap">
		    	<div class="beritaxx_head_setting">
				    <div class="taxx_clear top_feed">
				    	<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/beritaxx.png" /> <span><?php echo esc_html( $my_theme->get( 'Name' ) ) . ' ' .esc_html( $my_theme->get( 'Version' ) ); ?></span>
			         	<a target="_blank" href="https://beritaxx.com/teamxx/" target="_blank">Team XX</a>
				    </div>
				</div>
				<form class="beritaxx_pro_lisensi taxx_clear" action="" method="post" enctype="multipart/form-data">
			     	<?php
				    	wp_nonce_field('__beritaxx_prolibrary_activate', '__activate');
						
						$readonly = '';
						$value = '';
						
						$this->data();
						
						if ($this->status == 200 && $this->purchase_code) {
							$readonly = 'readonly';
							$value = substr_replace($this->purchase_code, '************************', 0, 30);
						}
						
						ob_start();
				    	?>
					
				    	<div class="beritaxx_prolibrary_section taxx_clear">
				    	
							<div class="beritaxx_prolibrary-field default beritaxx_pro_block left_block">
							    <?php
							    $timezone  = +7;
								$gmt7 = gmdate("d-m-Y H:i:s", time() + 3600*($timezone+date("I"))); 
							    $cools = strtotime($gmt7);
								$morecools = strtotime(date_i18n($this->expired_at));
								$countdown = $morecools-$cools;
								if ( $this->expired_at != "" ) {
									if ( $countdown > 0 ) {
										$status =  __( '<span class="active"> Active</span>', 'beritaxx' );
									} else if ( $countdown < 0 ) {
										$status = __( '<span class="inactive"> Expired</span>', 'beritaxx');
									}
								} else {
							    	$status = __( '<span class="inactive"> Not Active</span>', 'beritaxx');
						     	}
							?>
						    	<div class="beritaxx_prolibrary-field-label">
							    	<h3 class="status_lisensi"><?php echo sprintf(__( 'License : %s', 'beritaxx' ), $status ); ?></h3>
								</div>
								<div class="beritaxx_prolibrary-field-input">
							    	<div class="beritaxx_prolibrary-field__text taxx_clear">
								    	<input type="text" class="input_code_beritaxx" name="purchase_code" class="regular-text" value="<?php echo $value; ?>" <?php echo $readonly; ?>>
									    
								        	<?php if ($this->status != 200) : ?>
									        	<input type="submit" class="button beritaxx_button beritaxx_act" name="action" value="Activate">
									    	<?php else : ?>
								            	<input type="submit" class="button beritaxx_button beritaxx_deact" name="action" value="Deactivate">
									    	<?php endif; ?>
							  	    	
							    	</div>
								</div>
						    
								<div class="beritaxx_prolibrary-field-input">
							    	<div class="beritaxx_prolibrary-field__text">
									    <div class="taxx_clear taxx_notif">
										    <?php echo __( '<span class="red">IMPORTANT</span> : You can keep using Pro featured even if <span class="blue">LICENSE CODE</span> has <span class="red">EXPIRED</span>.<br/>
											With  notes never <span class="red">DEACTIVE</span> your <span class="blue">LICENSE CODE</span> from this website !!!.<br/><br/>
											What if your website crashes and needs to be reinstalled?<br/>
											It is very <span class="red">IMPORTANT</span> for you as website owner to regularly <span class="blue">BACKUP</span> website data on hosting<br/>
											So if the website is damaged you can <span class="blue">RESTORE</span> back your <span class="blue">BACKUP</span> data.', 'beritaxx' ); ?>
										</div>
									    <div class="support_class taxx_clear">
									        <?php 
										    	if ( $this->expired_at != "" ) {
											    	if ( $countdown < 1170627 && $countdown > 0 ) {
													?>
													
												    	<div class="block_class inactive">
													        <div class="class_inner">
															    <a target="_blank" href="https://beritaxx.com/dashboard/" target="__blank"><?php echo __( 'Renew License', 'beritaxx' ); ?></a>
																<span class="dashicons dashicons-controls-repeat"></span>
															</div>
														</div>
														<div class="block_class inactive">
													        <div class="class_inner">
														    	<span id="event" class="gorenew just_clear">
												                	<span class="countbox dayactive"><?php echo __( 'Expired in', 'beritaxx' ); ?> <span class="event_day"></span> <?php echo __( 'Day', 'beritaxx' ); ?></span>
												            	</span>
																<span class="dashicons dashicons-backup"></span>
													    	</div>
												    	</div>
												    	<script>

														function getTimeRemaining(endtime){
  														    var t = Date.parse(endtime) - Date.parse(new Date());
  					    									var days = Math.floor( t/(1000*60*60*24) );
  					    									return {
  														        'total': t,
  														        'days': days,
 														    };
														}

														function initializeClock(id, endtime){
  					    									var clock = document.getElementById(id);
  					    									var daysSpan = clock.querySelector('.event_day');

  													    	function updateClock(){
   						    								    var t = getTimeRemaining(endtime);
																
																daysSpan.innerHTML = t.days;
																
																if(t.total<=0){
																	clearInterval(timeinterval);
																}
															}
															
															updateClock();
															var timeinterval = setInterval(updateClock,1000);
														}
														
														var deadline = '<?php echo str_replace('-',' ', $this->expired_at); ?> UTC+0700';
														initializeClock('event', deadline);
												    	</script>
														
													<?php
												} else if (  $countdown < 0 ) {
													?>
													
												    	<div class="block_class inactive">
														    <div class="class_inner class_expired">
															    <?php echo __( 'License is Expired', 'beritaxx' ); ?>
																<span class="dashicons dashicons-editor-unlink"></span>
															</div>
												    	</div>
														<div class="block_class inactive">
													        <div class="class_inner">
															    <a target="_blank" href="https://beritaxx.com/dashboard/" target="__blank"><?php echo __( 'Renew License', 'beritaxx' ); ?></a>
																<span class="dashicons dashicons-controls-repeat"></span>
															</div>
														</div>
														
													<?php
												} else if ( $countdown > 1170627 ) {
													?>
												    	<div class="block_class onactive">
													    	<div class="class_inner">
															    <?php echo sprintf(__('Active until : %s', 'beritaxx'), date_i18n( 'd M Y', strtotime( $this->expired_at ) ) ); ?>
															</div>
														</div>
														<div class="block_class onactive">
													    	<div class="class_inner">
												            	<span id="event" class="goactive just_clear">
												                 	<span class="countbox dayactive"><?php echo __( 'Remaining', 'beritaxx' ); ?> <span class="event_day"></span> <?php echo __( 'Day', 'beritaxx' ); ?></span>
												             	</span>
													    	</div>
												    	</div>
												    	<script>

														function getTimeRemaining(endtime){
  														    var t = Date.parse(endtime) - Date.parse(new Date());
  					    									var days = Math.floor( t/(1000*60*60*24) );
  					    									return {
  														        'total': t,
  														        'days': days,
 														    };
														}

														function initializeClock(id, endtime){
  					    									var clock = document.getElementById(id);
  					    									var daysSpan = clock.querySelector('.event_day');

  													    	function updateClock(){
   						    								    var t = getTimeRemaining(endtime);
																
																daysSpan.innerHTML = t.days;
																
																if(t.total<=0){
																	clearInterval(timeinterval);
																}
															}
															
															updateClock();
															var timeinterval = setInterval(updateClock,1000);
														}
														
														var deadline = '<?php echo str_replace('-',' ', $this->expired_at); ?> UTC+0700';
														initializeClock('event', deadline);
												    	</script>
													<?php
											    	}
										    	} else {
													?>
												     	<div class="block_class onactive">
													    	<div class="class_inner">
														    	<a target="_blank" href="https://beritaxx.com/dashboard/" target="__blank"><?php echo __( 'Get License', 'beritaxx' ); ?></a>
																<span class="dashicons dashicons-cart"></span>
															</div>
														</div>
													<?php
										    	}
									       	?>
								        	
										    <div class="block_class problem">
										    	<div class="class_inner class_ask"><a target="_blank" href="https://beritaxx.com/problem/"><?php echo __( 'Q & A', 'beritaxx' ); ?></a><span class="dashicons dashicons-format-status"></span></div>
											</div>
											<div class="block_class problem">
										    	<div class="class_inner class_new"><a target="_blank" href="https://beritaxx.com/version/"><?php echo __( 'New Version', 'beritaxx' ); ?></a><span class="dashicons dashicons-tag"></span></div>
											</div>
											<div class="block_class problem">
										    	<div class="class_inner class_feature"><a target="_blank" href="https://beritaxx.com/fitur-tema/"><?php echo __( 'Theme Feature', 'beritaxx' ); ?></a><span class="dashicons dashicons-editor-ol"></span></div>
											</div>
											<div class="block_class problem">
										    	<div class="class_inner class_demo"><a target="_blank" href="https://demo.beritaxx.com/"><?php echo __( 'Theme Demo', 'beritaxx' ); ?></a><span class="dashicons dashicons-laptop"></span></div>
											</div>
											
								    	</div>
							    	</div>
								</div>
							</div>
						
							<div class="beritaxx_prolibrary-field default beritaxx_pro_block right_block">
						    	<div class="beritaxx_prolibrary-field-label">
								    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.jpg" style="max-width: 100%;"/>
								</div>
							</div>
						
						</div>
				</form>
				
			</div>
	<?php
		
    }

    /**
     * action submit
     *
     * @return void
     */
    public function on_save_action()
    {

        if (isset($_POST['__activate']) && wp_verify_nonce($_POST['__activate'], '__beritaxx_prolibrary_activate')) {
            if ($_POST['action'] == 'Activate') {
                $this->code = sanitize_text_field($_POST['purchase_code']);
                $this->activate();
            } else {
                $this->code = $this->purchase_code;
                $this->deactivate();
            }
        }
    }

    /**
     * api_response
     *
     * @param  mixed $response
     * @return mixed
     */
    private function api_response($response)
    {
        if (!is_wp_error($response)) {
            $result   = json_decode(wp_remote_retrieve_body($response), true);
            $code = intval(wp_remote_retrieve_response_code($response));
        } else {
            $result = [
                'status' => 999,
                'message' => $response->get_error_message()
            ];
        }

        return $result;
    }


    /**
     * activate 
     * 
     * activate the current
     *
     * @return mixed
     */
    private function activate()
    {
        $server = add_query_arg([
            'purchase_code' => $this->code,
            'id'            => $this->id,
            'host'          => $this->host
        ], $this->api);

        $result = $this->api_response(wp_remote_post($server));

        if (isset($result['message'])) {
            add_action('admin_notices', function () use ($result) {
                echo '<div id="message" class="notice notice-success"><p><strong>' . $result['message'] . '</strong></p></div>';
            });
        }

        if (isset($result['status']) && intval($result['status']) != 999) {
            $this->update_option($result);
        }

        return true;
    }

    /**
     * delete
     * 
     * delete the current
     *
     * @return void
     */
    private function deactivate()
    {
        $server = add_query_arg([
            'purchase_code' => $this->code,
            'id'            => $this->id,
            'host'          => $this->host
        ], $this->api);

        $result = $this->api_response(
            wp_remote_request(
                $server,
                ['method' => 'DELETE']
            )
        );

        if (isset($result['status']) && intval($result['status']) == 200) {

            unset($result['status']);
            $this->update_option($result);
        }

        if (isset($result['message'])) {
            add_action('admin_notices', function () use ($result) {
                echo '<div id="message" class="notice notice-error"><p><strong>' . $result['message'] . '</strong></p></div>';
            });
        }

        return true;
    }

    /**
     * check
     * 
     * checking the current
     * 
     * @return void
     */
    private function check()
    {
        $server = add_query_arg([
            'purchase_code' => $this->code,
            'id'            => $this->id,
            'host'          => $this->host
        ], $this->api);

        $result = $this->api_response(wp_remote_get($server));

        if (isset($result['status']) && intval($result['status']) != 999) {
            $this->update_option($result);
        }

        return true;
    }

    /**
     * periodic_check
     * 
     * on current periodic check
     *
     * @return void
     */
    public function periodic_check()
    {
        if ($this->purchase_code && $this->status == 200) {
            $this->code = $this->purchase_code;
            $this->check();
        }
    }
}

new Beritaxx_No_Lite();