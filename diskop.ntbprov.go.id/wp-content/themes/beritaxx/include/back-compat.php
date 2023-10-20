<?php
/**
 * Jika pengguna mengganti WordPress ke versi lebih rendah.
 * Kembalikan tema ke default theme.
 */
function beritaxx_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'beritaxx_upgrade_notice' );
}
add_action( 'after_switch_theme', 'beritaxx_switch_theme' );

function beritaxx_upgrade_notice() {
	$message = sprintf( 
	    /* translators: %s: WordPress version. */
	    __( 'Beritaxx need at least WordPress version 5.8. Your current version is %s.', 'beritaxx' ), $GLOBALS['wp_version'] 
	);
	printf( '<div class="error"><p>%s</p></div>', esc_html( $message ) );
}

function beritaxx_customize() {
	wp_die( sprintf( 
	    /* translators: %s: WordPress version. */
	    esc_html( 'Beritaxx need at least WordPress version 5.8. Your current version is %s.', 'beritaxx' ), esc_html( $GLOBALS['wp_version'] ) 
		), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'beritaxx_customize' );

function beritaxx_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( 
		    /* translators: %s: WordPress version. */
	    	esc_html( 'Beritaxx need at least WordPress version 5.8. Your current version is %s.', 'beritaxx' ), esc_html( $GLOBALS['wp_version'] ) ) 
		);
	}
}
add_action( 'template_redirect', 'beritaxx_preview' );
