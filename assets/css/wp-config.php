<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'khojdeal_cashback');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'Osiz@123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'e7Va)0Y!1O:/8sxVC)R+ZOdl0DiT,yEzYb-mn.uCGz/D1QdtEr|F>?T>aoVt5da$');
define('SECURE_AUTH_KEY',  '=S@@E,tF6f+$53;XggBeeS5Y)QKQPI,u6w<d;*M|)p|G1>%+SiRyShc,Ra&WEGt$');
define('LOGGED_IN_KEY',    'mH-.$[vXH}=A^DmeVm}.l@YZm7Owrn4m&m{;RwP*?wxWGk(1MOiLm6P+SK)*{SWv');
define('NONCE_KEY',        '6wt}0eZ#P1s{!?O)*H~Cqu0EdM*}L%x.%tYo%]gL&v;mk+`N rJ^G1U|}VKLF;s*');
define('AUTH_SALT',        'z;lR25)Xt6@.8LT8PC&;DT`_uQBJb|d}Q{I: <bAL.hex{2%(@<r4goyB5gl rq%');
define('SECURE_AUTH_SALT', '6gfa*r%-{b0T1h}v:Z|]gQ+g(%0bx%t<FkZsN0M*9ky)+{v:^V*|<9i+T/7B,Vs5');
define('LOGGED_IN_SALT',   '?hVN]6`pEIt3U|-Mp]>u={2:Bmwe-%_-!5Bk%.3$m -!;-8a1j]b*ge0ut.#-|l?');
define('NONCE_SALT',       '-x}bS+TXO80u+b#xV6Z[#_^:}{4A.~2v[NlwW4;B{ljaMt/]:]ML|9`f;2|hOVY3');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'cashin_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
