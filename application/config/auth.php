<?php defined('SYSPATH') OR die('No direct access allowed.');

return array(

	'driver'       => 'File',
	'hash_method'  => 'sha256',
	'hash_key'     => 'secretkey',
	'lifetime'     => 1209600,
	'session_type' => Session::$default,
	'session_key'  => 'auth_user',

	// Username/password combinations for the Auth File driver
	'users' => array(
		//password: 'admin'
		 'admin@example.com' => '7cada1744cf10b58d483677e0196acf3a9e4110714a9071e0f4fedd66281ba99', //Auth::instance()->hash('admin'),
	),

);
