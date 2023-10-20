<div class="taxx_form_search">
	<form method="get" id="searchpost" action="<?php home_url('/'); ?>">
		<div class="taxx_input">
		    <input name="s" type="text" placeholder="<?php echo esc_attr_e( 'Search something...', 'beritaxx' ); ?>" value="" />
			<input name="post_type" type="hidden" value="post" />
		</div>
		<div class="taxx_button">
			<button type="submit"><i class="fa fa-search"></i><span class="searching"></span></button>
		</div>
	</form>
</div>
