<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'gingsengweb' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'RA~5YeIjU{&=@KUKkx>$;I6HDjRkMmgvU}x3Q5o:CIdMw]A!5YS2+d{1mBa|;gw{' );
define( 'SECURE_AUTH_KEY',  '-=gGqyRw|G_~BU@9/vf#U2s;OGyVc_R.Gu}SP-jsoI#`!s/3EY@0w+OBDdbe c,}' );
define( 'LOGGED_IN_KEY',    'JB e5Y~?No/GK)3ByAIGJ=S23,lC_Ng=?+m=!;zwdtVvv4J!!MXb *ruqBC|OY5w' );
define( 'NONCE_KEY',        'B]82N7{k>==w!6FQJ}0y4|I`)_wCw)r942fhjVOpU}@;Iaoq8q1})cUD48vG1LZn' );
define( 'AUTH_SALT',        '?W3s7XHN!fw]QLe1{WcS{#{.x %C53RN>D^7a_N}O5RoL8bE0c,Jf|m7FU[VyX^@' );
define( 'SECURE_AUTH_SALT', 'Zbb5687cRWel8XXh3;V+Ttb{(?ACuz/<ptN]6ip*/z*c=tf-p`krR0WLE+xn}R_&' );
define( 'LOGGED_IN_SALT',   'hUFomF=`G!z6n.h+mlP_x1L TP@]7OxkC6-R_/,z_t=w](qj~l/v()yswX`l!kzG' );
define( 'NONCE_SALT',       '4ra;0g0[@;,N/DZE2zmdtv&(ID5_PKJJ{y$!ZYYPxA!Mzz#>+!|G3D+,VDDGU-[:' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
