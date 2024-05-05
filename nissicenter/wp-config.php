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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db_nissicenterwordpress' );

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

/**Nâng thông số WordPress memory litmit */
define( 'WP_MEMORY_LIMIT', '256M' );

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
define( 'AUTH_KEY',         'aa}>o~Bo6ev^*F!cMq9D|5I^=Jb6?-AoND_RiT;u5P;49T(%o^gJgkQlSta3Y&2.' );
define( 'SECURE_AUTH_KEY',  ' Vv{l:O<>:614p.O_kPEdc {d!{k~(l#5keFwd%C1o*yK<6(ds||1PinC8;`XDtn' );
define( 'LOGGED_IN_KEY',    '|U;sLm*,AU(&#7Y2nE-.I.Hw>G,.OS+MWtDf?KUx_@y~kQ+2z|c|]A$Ln@9]qTJn' );
define( 'NONCE_KEY',        'nPM+JN*whR3gs1hw.:F@%9IHICQ2z3 hC%)PhR&?JkOl8&-6Fuk6tC2uN)[#s+!-' );
define( 'AUTH_SALT',        'H)r<R?NZU{j+Yr?nxYhB^e}^lkIzk8)2SmC=BvC!|NNp.D`?6F_)J .LpLcLA(ku' );
define( 'SECURE_AUTH_SALT', 'Gcvb5:^r0;X]K/PwaH[Iqr/74cGs*nwW^Sf9C{X=:^o>2wQ>8p<[(5ilfG^&A!$b' );
define( 'LOGGED_IN_SALT',   '=o3#*a==N`AWhh[qc946je|V@y=c@cmcfX}O%j$&29T~C<rZf^i;-N+%{Ch3 9K!' );
define( 'NONCE_SALT',       'n6}xD@b+KTrQ^np^K kPp-4{c*;b@y^2(sad 0@D5lhehn!A|bKHppY?SMF?hMo8' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
