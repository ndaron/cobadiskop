            <div class="right_ads taxx_float_ads"><?php taxx_floating_right(); ?></div>
			<div class="footer_ads"><?php taxx_before_footer(); ?></div>
		</div>
		
		<div class="taxxfooter taxx_clear">			
                <div class="footer">
				    <div class="area_footer_menu taxx_clear">
					    <div class="block_menufooter taxx_clear">
						    <div class="tax_menufooter">
						    <?php 
								if (has_nav_menu('footerone')) {
									wp_nav_menu(array(
								    	'theme_location' => 'footerone', 
								     	'container' => 'div',
										'container_class' => 'footer_one',
										'menu_class' => 'beritaxx_menu', 
										'menu_id' => 'one',
										'fallback_cb' => false
									));
								} 
							?>
					    	</div>
					    	<div class="tax_menufooter">
						    <?php 
								if (has_nav_menu('footertwo')) {
									wp_nav_menu(array(
								    	'theme_location' => 'footertwo', 
								     	'container' => 'div',
										'container_class' => 'footer_two',
										'menu_class' => 'beritaxx_menu', 
										'menu_id' => 'two',
										'fallback_cb' => false
									));
								} 
							?>
					    	</div>
					    	<div class="tax_menufooter">
						    <?php 
								if (has_nav_menu('footerthree')) {
									wp_nav_menu(array(
								    	'theme_location' => 'footerthree', 
								     	'container' => 'div',
										'container_class' => 'footer_three',
										'menu_class' => 'beritaxx_menu', 
										'menu_id' => 'three',
										'fallback_cb' => false
									));
								} 
							?>
							</div>
						</div>
						<div class="taxx_logofooter">
						    <div class="taxx_footer_logo"><?php taxx_footer_logo(); ?></div>
							<div class="taxx_footer_text"><?php taxx_footer_text(); ?></div>
							<div class="taxx_social"><?php beritaxx_social_icon(); ?></div>
						</div>
						
					</div>
		        	<div class="copyright">
					    <?php taxx_text_footer(); ?>
		        	</div>
		    	</div><!-- footer --> 
        </div>
		<div class="bottom_ads"><div class="bottom_ads_inner"><?php taxx_bottom_ads_floating(); ?></div></div>
		<span class="oc_search"><span></span></span>
				
		<?php wp_footer(); ?>
	</body>
</html>