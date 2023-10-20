/**
 * Live-update changed settings in real time in the Customizer preview.
 */

( function( $ ) {
	wp.customize( 'header_switch', function( value ) {
        value.bind( function( to ) {
            $( 'body' ).attr( 'id', to );
        } );
    } );
} )( jQuery );
