	</div> <!-- Main -->
	<div class="clearfix"></div>
<footer id="footer"><div class="inner">
<div class="copyright"><?php echo of_get_option('footer');?></div>
		<div class="menu">
			<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'menu' , 'fallback_cb' => '' ) ); ?>
		</div></div>
		<div class="clearfix"></div>
</footer>
</div> <!-- Wrap -->
	<?php wp_footer(); ?>
</body>
</html>