<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u1566513_diskop' );

/** MySQL database username */
define( 'DB_USER', 'u1566513_diskop' );

/** MySQL database password */
define( 'DB_PASSWORD', '(W=U773yV[rb' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '~hIA2epBP JV#fuA*)784 ;4%4&YU7EU9&z$E~sW2Y2O},IbEBfaR/UZ3FV1vh`&' );
define( 'SECURE_AUTH_KEY',  'oIs!{s^+tB_2{Q,sLrwJ$rSV{#364hn/KT>HW:2ZY6OJVLv<{R!ix6k ]aFp%V]/' );
define( 'LOGGED_IN_KEY',    'cSy,1SrQJ08yf_wh+HFk3Bqwg1-h3poHd&mtl<{B%x01}J8M,Xu&9r_AnRWxUl+F' );
define( 'NONCE_KEY',        'xo&D:~=r#egv.K&qSa?:SbG]V?pk;4]H)n>I,!s%nH0&JnFU^=wK(48Kw`waqgVm' );
define( 'AUTH_SALT',        'S8B>c.cz@4ATZO{SYy}1Y{Rh&]%>CmfW{KkpzIRx^9J/p`=OR+Y)xFbwD>o=>37@' );
define( 'SECURE_AUTH_SALT', 'F>BUn2TE6FaAFXdUp{l*<)Gtqj.ukveEN=rNA4x^.TCpebL_NcH)Qy e<.@.?yL&' );
define( 'LOGGED_IN_SALT',   '4~a[vcyQc-MFJQKZBn|Jp}QX+erk)_eihYLV&!gs ?^34[7N 6;G#yA{bjID&Ie0' );
define( 'NONCE_SALT',       '#{]@=nI2C(j4]6t6{T#q_OtH3^s.pwSc/$%ENZE-| k5ie!,o(f+FTPJ/1]N,1d.' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
