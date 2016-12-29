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
define('DB_NAME', 'marydttr_wp516');

/** MySQL database username */
define('DB_USER', 'marydttr_wp516');

/** MySQL database password */
define('DB_PASSWORD', '3l@]P92i8S');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '1jkpy3gbukkv2lwskcd63asx9ud1zq6lhkxazwofyzqgd1jwps3jacdbv5uyihou');
define('SECURE_AUTH_KEY',  'ti3q5ofbjasu7cxydnkaxp8ihkvjcwtxmtk3tbembf8xtv6nj9ejheyf1dpinngh');
define('LOGGED_IN_KEY',    'fu6qnaaey1gyodq9ognkvte6dflesnpfxxxpbiar8qsw7pvlutz5vju5vjiikglr');
define('NONCE_KEY',        'vxxxo8wk1ggj4fzfgbiubgtbgepep9xmyy5wkcd12lhxkya0a5fsfbwhadke97kf');
define('AUTH_SALT',        'lht8r3pcxaujwsnjrmdvhpwak6ygiuqhmikri4rzub8aotkcv9ekq3tqvlcjzsj1');
define('SECURE_AUTH_SALT', 'et9vpccjk3naelnno6u0aw1reflymx6kh4oipdcejdeacs42ng9owfzzs66hkmcs');
define('LOGGED_IN_SALT',   'rxwvlkscyfjxzuqsfilzykuyhtwvquezkrysfwose3m86y4w6aysewjrl6lvxzf2');
define('NONCE_SALT',       'exg9gg5iwlhtl0yvyxbr7z6adw8g1s1gx0wi6gdnzkose7zwvxmbghyebwbvhwbt');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp7q_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
