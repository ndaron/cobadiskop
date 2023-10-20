<?php
define('WP_AUTO_UPDATE_CORE', 'minor');
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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'tukangli_dcenter');

/** MySQL database username */
define('DB_USER', 'tukangli_dcenter');

/** MySQL database password */
define('DB_PASSWORD', '8Spj.7D(2s');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ']1n1mDZau0+OQSIh]$8u%DJGCJ+4M.mO8<P`?OK&Cf].2rTDjuqJdiIK5>#3QZW6');
define('SECURE_AUTH_KEY',  '4/sWFn+Cr&[BoBNU,!AC,k:5k)=i?fUg3L[xx5MU)PJ}%ckn)vN?&1OD04Vyzv~p');
define('LOGGED_IN_KEY',    'T6Byr;8d5uGNRGOm89_AWQo&#lu:9:LB0iKHYK;yMj<(Jw;e8W?dr>=bp}D:E|jy');
define('NONCE_KEY',        'nf(c2xsc]u+*iq2Ecx]9;C!O3;R5>8 <n/}_KOd(zaLfCQ|yMw=$jm{u[T&.=mc&');
define('AUTH_SALT',        '04huUbI?f7,1>[kI>A|I}@T!u_lA#!;+h>8jFvzX&Y|W:.f:({);aIT,ubXy+wUx');
define('SECURE_AUTH_SALT', 'RLbu sq:4V_]7Db~{N(01E3H!VX95|*._o,pfxHBaL%vXDCZWl>@atN{b!jd^R5<');
define('LOGGED_IN_SALT',   '@^lNvxD h*`KP=#h W|+(0jfz@@KO~Z#%H#-^^OPbJbfG%XHW-!2k2:~ES|Dx|OT');
define('NONCE_SALT',       '@RuT[gBM&]YS+aw;@^Q(hnADA_Y5,FgKwK`s]o 0bk5,#im)F2eHOR`,C=944V+)');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
