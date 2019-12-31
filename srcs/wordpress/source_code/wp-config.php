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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wp_user' );

/** MySQL database password */
define( 'DB_PASSWORD', 'secure_password' );

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
define( 'AUTH_KEY',         'rLt2%QY&>nQ)2xZoY|d/&}3V*`?#VpFQSFVZT>W;*~7J)<lDmjek;90Xrhm)bt}r' );
define( 'SECURE_AUTH_KEY',  'c7n-?tC0rv%d(YBb2XYLTo{`4wfI2>i=Hv:f&YlzIFY^l}2}wLo`oT,{3lKFP$<l' );
define( 'LOGGED_IN_KEY',    'FMs>]XybH~EEa}F3v.erNPWT@_X%K3,^(qSaMsz_pMK|$9G@IbU`q$9-%&]Va09!' );
define( 'NONCE_KEY',        'J3gm>m]f*-WTea*;&#ip13!)v#ypaa)qa&E{?6DXg9,atCE/Oj:oRej}emIr(vJX' );
define( 'AUTH_SALT',        'DWih![VIi[uy,+)DpfZ*#4%VqWR}qQ2cyUVCRG{~yOD2;`u]WhSzJXGv$Fo&qV:%' );
define( 'SECURE_AUTH_SALT', '8/[xCbD%v9Jy0$tzW|Z}@(tW5iT?^yQk$-,IJ@dNGS,cg8/h:+:2?ocbh`vG]=yI' );
define( 'LOGGED_IN_SALT',   ',l.dK)2f c~:mYIF>PTX>ub%VZchox0X{-$4CEA@9BX/kLYcx;wDO0JtZBYXc.Nj' );
define( 'NONCE_SALT',       '!Usjd{4QSsyRjz,Ok,F+ 1WMaA|xzdO9]:42=H/Bd:hF3RhCWBd*;_CtU=|Fq4~Y' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
