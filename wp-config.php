<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'komorebi');

/** MySQL database username */
define('DB_USER', 'adminqqN3VXS');

/** MySQL database password */
define('DB_PASSWORD', '7j5jQlFbxNT2');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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

define('AUTH_KEY',         'L6Z%%s<B}1oi##?WtOA.:|:`=B(IaT9z?nO[L:Xn>;DiTb$?Sth$a:+HO+a;jW4L');
define('SECURE_AUTH_KEY',  'Th4G=C4&pM3[6|^j{`hk{S%%Ov^ta1OWuUkS`|0x=XiGZAVS3!+H%I&*+-^QI19V');
define('LOGGED_IN_KEY',    ' bu1bbs8@~aEF|[]O%qi</DN_O4+4j,.8[_&Tww[ve1OPD-t-=.D_IXSBirre{:&');
define('NONCE_KEY',        '/3IU:(-b$|g9:L&pjj^j=RaTnF5+RBw&js1BsV(/<=l?{b*mnv9qDmGCa#d%`-W$');
define('AUTH_SALT',        'fi*~K`(t^Gydp8%y4=-NkZkYrP:f*A3.Sc_N&t|p-&9<__Pq59qy.G$~7GOdE?V-');
define('SECURE_AUTH_SALT', 'h,m/fG(6ubb2`C+-J{W( 7Hx8eYgM69rosX7.Xc.Xzr^YGkRTTRkP5EDIg#t_?L-');
define('LOGGED_IN_SALT',   'X^-nH2-r&*yi% R?VCc{#F]1tUD?ycCUE|$dE}4.>kR(E+_nKoaQ/y6][}MK1jIh');
define('NONCE_SALT',       'UocS.7~baaVH_nt[P-X:W(V|Sx<?tT76+-[lI-+7yL&e6N0kfo2RKZ |Bx3wCCtW');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

