<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'peterjwa_boot');

/** MySQL database username */
define('DB_USER', 'peterjwa_boot');

/** MySQL database password */
define('DB_PASSWORD', 'nS6yw35Plq');

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
define('AUTH_KEY',         'wogv3p1ozrfvuf9ulczmisrd2tmw5g90pwqbtnlfgzoxl0fvowhxkrqckvwov8l2');
define('SECURE_AUTH_KEY',  'ascxbi7ygzngtge72lqeggmjgemqh0dqa3tufuqidd6jujpkvskzo6cxoyjztvcj');
define('LOGGED_IN_KEY',    'bws5jytrpep10llshyunjjtyivh2s1ve4cjlwjzoyxpcukojcdd7cigcm5daii3s');
define('NONCE_KEY',        'zqkk6iq9kqmmc2jo8vznnmc4zvvpme75ujns3qcfq5obj5xeaufs7qfssmde1afc');
define('AUTH_SALT',        '75wycqjjppqbqbovwcmupwjmwnr5s0ppn7scyfjuodm2bvw49w43yenjlc8g9rlp');
define('SECURE_AUTH_SALT', 'dxwec1n9skynjb68qkbziqt0hwc4w1uo5g04ky9a5e7so6vhay4noo81qnaut3iy');
define('LOGGED_IN_SALT',   'yhocblfgty5udnuve406lestib1t8z0xzzeeom2vswq8mhkk3gtpwfvm6iskvhdy');
define('NONCE_SALT',       'm0fb5ggvpjb4n9g0hzr4mzcxhrfsodmedaqzuvy6mykdzbew98xstkanuwcknqfo');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define ('WPLANG', '');

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
