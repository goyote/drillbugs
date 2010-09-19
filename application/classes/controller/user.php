<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_User extends Controller_Drillbugs {

	public function action_sign_in()
	{
		if ($this->auth->logged_in())
		{
			// If user already logged in, this page
			// is pointless. Redirect user to app
			$this->request->redirect('/');
		}

		// Set the page title
		$this->template->title = 'Drillbugs: Sign in';

		// Set the page
		$this->template->content = View::factory('user/login')
			->bind('errors', $errors)
			->bind('post', $post);

		if ($_POST)
		{
			// Attempt to login the user, redirect if successful
			ORM::factory('user')->login($_POST, '/');

			// You've hit this line because there
			// was a problem. Grab the error messages
			$errors = $_POST->errors('login');

			// Pass the submitted values back
			// to the view for sticky forms
			$post = $_POST->as_array();
		}
	}

	public function action_sign_out()
	{
		// Logout and destroy session
		$this->auth->logout(TRUE);

		// Redirect to sign in page
		$this->request->redirect('/');
	}

	public function action_sign_up()
	{

	}

	public function action_forgot_password()
	{
		
	}

} // End Controller_User