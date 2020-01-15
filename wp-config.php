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
define( 'DB_NAME', 'dbgcacbgh3xxv9' );

/** MySQL database username */
define( 'DB_USER', 'uncupn4x7c297' );

/** MySQL database password */
define( 'DB_PASSWORD', 'agu7w9mjt2jr' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'mLMw2ki#: -%gqoK``P f*~d*Ef*|fkHK&5KV{-oqR/~w,)LF@yuBvj.k2>1;%p6' );
define( 'SECURE_AUTH_KEY',   'CZFZhFmFM},Dg52YkFr0y]KXvD8)SW0;jnXjC/jn@Ry{7G)Mf4o,L)!Z,U^~m7vf' );
define( 'LOGGED_IN_KEY',     '0{niljoQuv;U0FV1$! v?B{/fac>6pK(Arc?f% ze%$;s$HJi@Rk^P2*0Ra|~hDM' );
define( 'NONCE_KEY',         '-.eCq0@q+S1eC/Q<cW>Pue==MM%*qB2a%@F]!v qKffmr54ZF^>)lbU.MQ]sxx1P' );
define( 'AUTH_SALT',         'G=L;52A=t+y|hp_)8fN=M:yggo#A8ZerOR!cKvC!>}UO{/AxSE91|,d5i8N4.]1V' );
define( 'SECURE_AUTH_SALT',  'O,U5z{2%G=5W%fGc4|M3bK6Jxj*/8SeFw]w;j:v]AB<m+o5@VAoq1rLXAuNZW4&r' );
define( 'LOGGED_IN_SALT',    '_u7G5Lj8|H}+v!.mAH=F|_jl<W=qB6P!7Qv/]03H}XL?1z<Z=w~;9N_S&kCQ$8HL' );
define( 'NONCE_SALT',        'Vo}Pd]m4l!!nZ|{vZvZ0)|D`O@(:Apm{)NQT@qgP7~]MEgE6K)S)mo80:Sxj6QiE' );
define( 'WP_CACHE_KEY_SALT', 't*}RYakV9m$QG>|{ uG#Rc#x)65R`YuQRhQF[>s=ofMH8^cwKq$27kIp^Ja%x|2L' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system
