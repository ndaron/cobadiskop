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
define('DB_NAME', 'tukangli_ppid');

/** MySQL database username */
define('DB_USER', 'tukangli_ppid');

/** MySQL database password */
define('DB_PASSWORD', '9S-U5p4[f0');

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
define('AUTH_KEY',         'oa(hXI%GF&,zl#sCjE4N*V&3i7NXJjBm1*:nX.GhHMs6+F}l{NwiZPUE%YK)HQz0');
define('SECURE_AUTH_KEY',  '@JedbT-~pVB-uJXhq9SG5]%+9T4(O$wVJbW1TsVbp-4_+.8RYY=u)}+86IjPjyxY');
define('LOGGED_IN_KEY',    'stB@tlb-F?V?;a?z2XMIu&$p<w5=~p#`A :HSvl.Lg@s_$kByG(WrtU#.J6k}F<s');
define('NONCE_KEY',        '5l,&v|[4LhRQkViTN%QhIJl}[J)<51r5EUQH:l3,2$.w_CfmG#{wFTj~CeUUE?u,');
define('AUTH_SALT',        ' }[gqHXgGOZ$INHCIhEqYg0o:Rk2qh._q0Q6=n&X?wC^g[mG0`<h$)]w!j(eAs Y');
define('SECURE_AUTH_SALT', '!VbIRUYZ-JLLTx~`V[;S2qSy+DV6-UNrzCvTkjco~L&!hm7IWYNDMJ/$!4u@EwM.');
define('LOGGED_IN_SALT',   'JIH#q{fS1@{e=Y#Tp7<K *F;!59QB7OK1O9[ ~Mv;ZSOqDx`z4;>4owQNvVgX151');
define('NONCE_SALT',       '5sX;bPDM=xA|ltrTN|h@<nkA9]`#&)yA-!G<:LZM^Sn[s3zS<SxF;{tU(L)XeU Z');

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
