<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	'default' => array
	(
		'type'       => 'MySQLi',
		'connection' => array(
			/**
			 * The following options are available for MySQL:
			 *
			 * string   hostname     server hostname, or socket
			 * string   database     database name
			 * string   username     database username
			 * string   password     database password
			 * boolean  persistent   use persistent connections?
			 * array    variables    system variables as "key => value" pairs
			 *
			 * Ports and sockets may be appended to the hostname.
			 */
			'hostname'   => 'localhost',
			'database'   => 'db name',
			'username'   => 'db user',
			'password'   => 'db password',
			'persistent' => FALSE,
            'ssl'        => NULL,
		),
		'table_prefix' => 'zst_',
		'charset'      => 'utf8',
		'caching'      => FALSE,
	),
);
