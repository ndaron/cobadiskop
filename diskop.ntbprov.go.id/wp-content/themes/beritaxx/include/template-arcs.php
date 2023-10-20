<?php
/*
 * Register widget (sidebar).
 */
function beritaxx_widgets_init() {
	require get_template_directory().'/widgets/full-small-slide.php';
	register_widget('FullSmallSlide');
	require get_template_directory().'/widgets/full-top-comment.php';
	register_widget('FullTopComment');
	require get_template_directory().'/widgets/full-category-block.php';
	register_widget('FullCatBlock');
	require get_template_directory().'/widgets/full-slide-paris.php';
	register_widget('FullSlideParis');
	require get_template_directory().'/widgets/full-slide-amsterdam.php';
	register_widget('FullSlideAmsterdam');
	require get_template_directory().'/widgets/full-slide-berlin.php';
	register_widget('FullSlideBerlin');
	require get_template_directory().'/widgets/full-trending-overlay.php';
	register_widget('FullTrendingOverlay');
}
add_action('widgets_init', 'beritaxx_widgets_init');

function beritaxx_pre_set_transient_update_theme ( $transient ) {
	
		if( empty( $transient->checked['beritaxx'] ) )
			return $transient;
		$checking = curl_init();
		curl_setopt($checking, CURLOPT_URL, 'https://beritaxx.com/update/pro.json' );
		// 3 second timeout to avoid issue on the server
		curl_setopt($checking, CURLOPT_TIMEOUT, 3 );
		curl_setopt($checking, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($checking);
		curl_close($checking);
		// make sure that we received the data in the response is not empty
		if( empty( $result ) )
			return $transient;
		//check server version against current installed version
		if( $data = json_decode( $result ) ){
			if( version_compare( $transient->checked['beritaxx'], $data->new_version, '<' ) )
				$transient->response['beritaxx'] = (array) $data;
		}
		return $transient;
	
}
add_filter ( 'pre_set_site_transient_update_themes', 'beritaxx_pre_set_transient_update_theme' );