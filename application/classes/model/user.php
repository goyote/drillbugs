<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_User extends Model_Auth_User {

	// Field labels
	protected $_labels = array(
		'username'         => 'Username',
		'email'            => 'Email address',
		'password'         => 'Password',
		'password_confirm' => 'password confirmation',
	);

	// Validation rules
	protected $_rules = array(
		'username' => array(
			'not_empty'  => NULL,
			'min_length' => array(2),
			'max_length' => array(32),
			'regex'      => array('/^[-\pL\pN_.]++$/uD'),
		),
		'password' => array(
			'not_empty'  => NULL,
			'min_length' => array(8),
			'max_length' => array(32),
		),
		'password_confirm' => array(
			'matches'    => array('password'),
		),
		'email' => array(
			'not_empty'  => NULL,
			'min_length' => array(6),
			'max_length' => array(132),
			'email'      => NULL,
		),
	);

	/**
	 * Validates registration information from an array, and optionally redirects
	 * after a successful registration.
	 *
	 * @param   array    values to check
	 * @param   string   URI or URL to redirect to
	 * @return  boolean
	 */
	public function register(array & $array, $redirect = FALSE)
	{
		$array = Validate::factory($array)
				->label('username', $this->_labels['username'])
				->label('email', $this->_labels['email'])
				->label('password', $this->_labels['password'])
				->filter(TRUE, 'trim')
				->rules('username', $this->_rules['username'])
				->rules('email', $this->_rules['email'])
				->rules('password', $this->_rules['password'])
				->rules('password_confirm', $this->_rules['password_confirm']);

		foreach($this->_callbacks['username'] as $callback)
		{
			// Execute username callbacks
			$array->callback('username', array($this, $callback));
		}

		foreach($this->_callbacks['email'] as $callback)
		{
			// Execute email callbacks
			$array->callback('email', array($this, $callback));
		}

		// Registration starts out invalid
		$status = FALSE;

		if ($array->check())
		{
			// Assign the user info
			$this->values($array);

			// Create the user
			$this->save();

			// Add the login role to the user
			$this->add('roles', new Model_Role(array('name' =>'login')));

			// Sign the user in
			$status = Auth::instance()->login($array['username'], $array['password']);

			if ($status AND is_string($redirect))
			{
				// Redirect to the user account
				Request::instance()->redirect($redirect);
			}
		}

		return $status;
	}

	/**
	 * Log a user out and optionally redirect.
	 *
	 * @param   boolean  completely destroy the session
	 * @param	boolean  remove all tokens for user
	 * @return  boolean
	 */
	public function logout($destroy = FALSE, $logout_all = FALSE, $redirect = FALSE)
	{
		$status = Auth::instance()->logout($destroy, $logout_all);

		if ($status AND is_string($redirect))
		{
			// If logout was successful then redirect
			Request::instance()->redirect($redirect);
		}

		return $status;
	}

} // End User Model