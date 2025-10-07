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
define( 'DB_NAME', 'lksn23_wp_2' );

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
define( 'AUTH_KEY',         ';9FP93e;jy&!Epb.~l_|v0Gg:,S0:X]&7`j&G(rYVH(TfP)y=-8;iQ6?P<Lz4u|X' );
define( 'SECURE_AUTH_KEY',  '6))I@(ydxSBYRyVZO2}!o>v+x(Ct$|69cNOO+B&xg2eGz?+5^TiBUr<Y ^G_uj}8' );
define( 'LOGGED_IN_KEY',    'Ct`CtO]o<!iISshbgk)5Ysq*98N063J2t8^x$Lm)`2()Zg^P#j^]h2yBF6WIw.kf' );
define( 'NONCE_KEY',        'XJro?CtXaLSReZ[*Q.9Ls(>RK;YnMm<^K5&F>^5JO8u eq}fY#+l3k:>mdtHrGv1' );
define( 'AUTH_SALT',        '#b7C`/vO{tZ|oRiG{`noF]64*3_}Yz#j(C_)xNl|hz*F~m=o;(yd;t$Rp-EZTTak' );
define( 'SECURE_AUTH_SALT', 'a<r_6UQ&FH)0q,v6/DHo@,By(}!rOU2.00|-F)?0H}]uVZ6*~xDH.})TzxM;&bcd' );
define( 'LOGGED_IN_SALT',   's/MS$ly 3%Nl;.2zq}@L.aLQi?j+Wr2K6C-`*LE],mmld.J>#_5 JF/ ]U O~D?M' );
define( 'NONCE_SALT',       'vh{v]VtN$2{t}@azlpz2#-fRD:)?dsba]h>fn.~ZUU#lJ@%qn-o@j6*Zdaj_shj2' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
