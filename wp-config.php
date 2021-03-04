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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'setup-school' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'mg=_UaQx]n_shc@KM>jvXV*qsYvDey}bOMw{<.v8}uKVsy!g7r(*VpPYe3%ns2<m' );
define( 'SECURE_AUTH_KEY',  'oPF*Z(lL7UJ,1f`+XcU i_|f|Ye;x(JS2SL3[ZW&eX^/&bMV@=Gyx;ps>x3g0<K8' );
define( 'LOGGED_IN_KEY',    '?b*b{/Xl*|>(Ymy5%nu3C4{$hP zIja+j3xM6S {oU5: A-u{za$V_3B_{Fq%9Lo' );
define( 'NONCE_KEY',        'w+|k%[z {]ieOVA.AV8mqle5Ia[K$bwGr!!p<}>(gmxN1KB!9zIxLKX*gy^GRX5(' );
define( 'AUTH_SALT',        '*^)EC%[UO]>/P!`zfW@}Ra`_BDD2(}#jy6KQ]{49Tg4S6]03^.fZsw~cs~./Ou]&' );
define( 'SECURE_AUTH_SALT', 'KcAl*a4A1`J2~GP2v?eaK3I#p]8UEzAn^XOelJve}e=b? z>w%POhW5@q{_7$xI^' );
define( 'LOGGED_IN_SALT',   'Y[AX60,/mz}<VvKVnSm3_W&laFQrN},%r5lU}GL3}{6eg[]C#UGMtS`hB0hwzfx(' );
define( 'NONCE_SALT',       '^{^-;1oApj`/Vs;;D@];b1T8Dx{Zjm?E{%x6x#(X.1X*`hkXbi$-aOs~Q>Ui~vM,' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
