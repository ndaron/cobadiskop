<div id="sidebar">
	<?php
	if ( ! is_search() XOR ! is_page() XOR ! is_archive() ) {
	$ads1 = of_get_option('ads3'); if(($ads1 == '')) {
	} else { ?>
	<div class="ads">
		<?php $ads_txt1 = of_get_option('ads_txt3'); if(($ads_txt1 == '1')) { ?>
		<h3 class="widget-title"><span>Advertisement</span></h3>
		<?php } else { } ?>
		<div class="widget_ads">
		<?php echo of_get_option('ads3'); ?>
		</div>
	</div>
	<?php } 
	}
	?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?>
<?php endif; ?>
</div>