<?php
// tema beritaxx

function additional_user_fields( $user ) { ?>
	<h3><?php echo esc_html_e( 'Social Media', 'beritaxx' ); ?></h3>

	<table role="presentation" class="form-table">
        <tbody>
		
		<tr class="user-user-login-wrap">
			<th><label for="whatsapp"><?php esc_html_e( 'WhatsApp', 'beritaxx' ); ?></label></th>
			<td>
				<input type="text" name="uwhatsapp" placeholder="<?php echo esc_attr_e( '62', 'beritaxx' ); ?>" class="regular-text" value="<?php echo esc_attr( get_the_author_meta( 'uwhatsapp', $user->ID ) ); ?>" />
			</td>
		</tr>
		<tr class="user-user-login-wrap">
			<th><label for="ufacebook"><?php esc_html_e( 'Facebook', 'beritaxx' ); ?></label></th>
			<td>
				<input type="text" name="ufacebook" placeholder="<?php echo esc_attr_e( 'https://...', 'beritaxx' ); ?>" class="regular-text" value="<?php echo esc_attr( get_the_author_meta( 'ufacebook', $user->ID ) ); ?>" />
			</td>
		</tr>
		<tr class="user-user-login-wrap">
			<th><label for="utwitter"><?php esc_html_e( 'Twitter', 'beritaxx' ); ?></label></th>
			<td>
				<input type="text" name="utwitter" placeholder="<?php echo esc_attr_e( 'https://...', 'beritaxx' ); ?>" class="regular-text" value="<?php echo esc_attr( get_the_author_meta( 'utwitter', $user->ID ) ); ?>" />
			</td>
		</tr>
		<tr class="user-user-login-wrap">
			<th><label for="uinstagram"><?php esc_html_e( 'Instagram', 'beritaxx' ); ?></label></th>
			<td>
				<input type="text" name="uinstagram" placeholder="<?php echo esc_attr_e( 'https://...', 'beritaxx' ); ?>" class="regular-text" value="<?php echo esc_attr( get_the_author_meta( 'uinstagram', $user->ID ) ); ?>" />
			</td>
		</tr>
		<tr class="user-user-login-wrap">
			<th><label for="utwitter"><?php esc_html_e( 'Youtube', 'beritaxx' ); ?></label></th>
			<td>
				<input type="text" name="uyoutube" placeholder="<?php echo esc_attr_e( 'https://...', 'beritaxx' ); ?>" class="regular-text" value="<?php echo esc_attr( get_the_author_meta( 'uyoutube', $user->ID ) ); ?>" />
			</td>
		</tr>
		
        </tbody>
	</table><!-- end form-table -->
	
    <?php 
} 

add_action( 'show_user_profile', 'additional_user_fields' );
add_action( 'edit_user_profile', 'additional_user_fields' );
	
function save_additional_user_meta( $user_id ) {
    	if ( !current_user_can( 'edit_user', $user_id ) )
	    	return false;

		update_user_meta( $user_id, 'uwhatsapp', isset($_POST['uwhatsapp']) ? sanitize_text_field(wp_unslash($_POST['uwhatsapp'])) : '' );
		update_user_meta( $user_id, 'ufacebook', isset($_POST['ufacebook']) ? sanitize_text_field(wp_unslash($_POST['ufacebook'])) : '' );
		update_user_meta( $user_id, 'utwitter', isset($_POST['utwitter']) ? sanitize_text_field(wp_unslash($_POST['utwitter'])) : '' );
		update_user_meta( $user_id, 'uinstagram', isset($_POST['uinstagram']) ? sanitize_text_field(wp_unslash($_POST['uinstagram'])) : '' );
		update_user_meta( $user_id, 'uyoutube', isset($_POST['uyoutube']) ? sanitize_text_field(wp_unslash($_POST['uyoutube'])) : '' );
		
}

add_action( 'personal_options_update', 'save_additional_user_meta' );
add_action( 'edit_user_profile_update', 'save_additional_user_meta' );