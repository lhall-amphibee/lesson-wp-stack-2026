<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db' );

/** Database username */
define( 'DB_USER', 'db' );

/** Database password */
define( 'DB_PASSWORD', 'db' );

/** Database hostname */
define( 'DB_HOST', 'db' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'ax87})zD>ZBxeS}hg)Gd6.2o6CzjdV>FCIG1Dv|.HZ`{@.r4v&S5GB(^_b`Ion( ' );
define( 'SECURE_AUTH_KEY',   '6:X7H@N~yj6ACwHF0/Yo~$M[qWlpgtHJ>U`jevhJsw:5a`u=i8X[m6$2a{nQ1GDO' );
define( 'LOGGED_IN_KEY',     'H>:AMWyVb_|=(V?OyzA&{%Y%OYcF/k+L3~FFRY.Z{0H;oO$V{2$[L! NUML@YG)s' );
define( 'NONCE_KEY',         'j]s58Yf?%ic8-7Rve_8`H6~Br40~vC?R<eyW8($]b`&}eqA%nP[;tpM8Xng+Zt&>' );
define( 'AUTH_SALT',         '#yg=kOWW[G NX-X:K$m>SPX`.Qw0aF#:BokQ:4,B1/)m4*1zD>LP@&IBE/$,X3fn' );
define( 'SECURE_AUTH_SALT',  'p~p{fIAuDb$_]yO#]6YVB#Ozp@X/d6JNhiM:2Fs9CN|figdiXa}$#LQvgy*(j!X+' );
define( 'LOGGED_IN_SALT',    'hiMAn(NE`:uLz~d&9A<)GEl!=-^sk:6;$y~>tEKHk+-xT$+|h~*fVGvTaXV~(8Ux' );
define( 'NONCE_SALT',        ']3b}|G#y5&RT~F/3kwI3wA;Dss3)W& tGtNMMm@PbOONQy6(mP/A^HFw4XxVlK*I' );
define( 'WP_CACHE_KEY_SALT', 'fLU<JJqf$=`gR*sPbB9Pt8-|.i*#P$xefdzigEBQPd?MW3J$v:QcH_O/Af?)PEJw' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
