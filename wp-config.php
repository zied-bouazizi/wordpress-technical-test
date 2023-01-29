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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_technical_test' );

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
define( 'AUTH_KEY',         'o9F*=bKcKVI,qj#|LDyu9*-+W^*aA+M]NqR#u!x4Hh:Mvw.#gUauPQ[4m~|Oa|D>' );
define( 'SECURE_AUTH_KEY',  '~n?u*@Fi3.89Q$Jbd8ses3%d%_VP%#m^EJcs+F]Qwb@[clE*hr}B!!QxMH(?c}uh' );
define( 'LOGGED_IN_KEY',    '+Sj*d.v<<<Cxwg2v,2Jl;G_;TZM6lT)z_3x;X ZJE/c~QN*Z|dE<M&JLv9<ACYE|' );
define( 'NONCE_KEY',        '|3=helBMbhq!)_XP{UxK%NXkGje[Cw!itlF+Scl%6*c|6S{7b~-=[}p.1`qm;8jx' );
define( 'AUTH_SALT',        'uN_(#g;NlPnA|RLf.nVRiV<xv+H-H.Y@U}_SD>CKjqZOpR1o+@#P.wf|j,+_J  &' );
define( 'SECURE_AUTH_SALT', 'ico(;Sm[![7qEeyGC2Vx8S,6F;LNvjdCU/5SwK_F&7Zqp)|PEv;JA]X;<+pl,T^w' );
define( 'LOGGED_IN_SALT',   'ugZpGAg@hUaXv}rJQ]eDK!Uz)&z-Qw~iznV0.RfZK(=5uzgd)`?#OGhJ2 PcEzwl' );
define( 'NONCE_SALT',       'YrgV8zmh&Z{>T+f}>+k[V]n>tXWS:Qbtw$7vv`v&g)GVEKJ:Y7js]=dE((=t`Z9n' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
