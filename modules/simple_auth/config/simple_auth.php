<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Type of hash to use for passwords. Any algorithm supported by the hash function
 * can be used here. Note that the length of your password is determined by the
 * hash type + the number of salt characters.
 * @see http://php.net/hash
 * @see http://php.net/hash_algos
 */
$config['hash_method'] = 'md5';

/**
 * Defines the secret string added to password (as prefix) before hashing
 */
$config['salt_prefix'] = 'simple_auth_secret';

/**
 * Defines the secret string added to password (as suffix) before hashing
 */
$config['salt_suffix'] = '_secret';

/**
 * Set the auto-login (remember me) cookie lifetime, in seconds. The default
 * lifetime is two weeks.
 */
$config['lifetime'] = 1209600;

/**
 * Set the session key that will be used to store the current user.
 */
$config['session_key'] = 'auth_user';

/**
 * Set the cookie that will be used to store the current user.
 */
$config['cookie_key'] = 'auth_auto_login';

/**
 * default roles, values must be empty.
 */
$config['roles'] = array('admin'=>'','active'=>'','moderator'=>'');

/**
 * password field name
 */
$config['password'] = 'password';

/**
 * unique field checked as username
 */
$config['unique'] = 'email';

/**
 * unique field checked when creating user, to prevent duplicating email or username value
 */
$config['unique_second'] = 'username';