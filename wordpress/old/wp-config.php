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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ykingswp');

/** MySQL database username */
define('DB_USER', 'ykings_user');

/** MySQL database password */
define('DB_PASSWORD', 'FZUcDZNMtE5emdrj');

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
define('AUTH_KEY',         '_`{;lu,-nmi!BzD<-amikzyLOnkX|0@g9h0{1d_qf[,-t5&).Q_u!R5H^/q%IxZH');
define('SECURE_AUTH_KEY',  'WK$Gy;||^A,.R`vSQ5-xB>z^yAiK;+t ?Cp5S7suv|.&W(4R|k8s+n240&3/{LhY');
define('LOGGED_IN_KEY',    'yZaU<%J85*/{7 06+Y:~Jo|~t1FH7Vrhy#r2P./Pf4[1[~),5=.o<&MRTvIhQl};');
define('NONCE_KEY',        '1sQw8zL9$uOY2>SPL~n}<&gy0VW8m:uU[LR)},0n*{0T[+gr;.Vm47t9~ir!vjb5');
define('AUTH_SALT',        'OR14!o_VWN(-,i9-z;Qn!MhDvt$@&}|K=j+uXy.OT!pl3?INPPaXD&S3_)fp|PJS');
define('SECURE_AUTH_SALT', 'djML!M[yn8^L[[<6:xSHK0MKl,D2Fvn]??[h:W&RX3<&6p7IZ)@(OWqsrfO|YV$x');
define('LOGGED_IN_SALT',   'O,cYvNS}9zV2R#-+NMqV&,JQ#y n%b5CBciNPVhE-C&;Y88*fSyDkJarK[~qY.y:');
define('NONCE_SALT',       ' oN=,{h<$k{TA9o]e(v6%ZF!K}HRP!7Mv&XdTizlI-d8j#k$qAV?A%#m]-%WfSTB');

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
