			    <div class="taxx_container taxx_clear taxx_header">
				    <div class="taxx_menu"></div>
					<div class="taxx_logo">
						<?php taxx_custom_logo(); ?>
					</div>
					<div class="taxx_search">
						<?php get_search_form(); ?>
					</div>
					<div class="taxx_mode">
				    	<div class="theme-switch-wrapper">
					    	<label class="theme-switch" for="checkbox">
					        	<input type="checkbox" id="checkbox" />
					        	<div class="slider round"></div>
					        </label>
				    	</div>
					</div>
					<div class="taxx_social"><?php beritaxx_social_icon(); ?></div>
				</div>
		    	<div id="taxxmenu" class="taxx_container taxx_flat_menu taxx_clear">
				<?php 
					if (has_nav_menu('navigation')) {
						wp_nav_menu(array(
					    	'theme_location' => 'navigation', 
					     	'container' => 'div',
							'container_class' => 'nav',
							'menu_class' => 'dd desktop deskmenu', 
							'menu_id' => 'dd',
							'fallback_cb' => false
						));
					}
				?>
				<span class="taxx_tanggal"><?php echo esc_html( date_i18n('l, d M Y') ); ?></span>
				</div>