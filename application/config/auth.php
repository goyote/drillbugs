<?php defined('SYSPATH') or die('No direct access allowed.');

return array(

	'driver'       => 'ORM',
	'hash_method'  => 'sha1',
	'salt_pattern' => '2, 5, 8, 11, 15, 18, 22, 26, 37, 39',
	'lifetime'     => 1209600,
	'session_key'  => 'auth_user',

);