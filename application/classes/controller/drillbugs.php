<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Drillbugs extends Controller_Template {

	/**
	 * @var  object  Auth instance
	 */
	protected $auth;

	/**
	 * @var  object  Session instance
	 */
	protected $session;

	/**
	 * @var  string|array  Controls access to the whole controller
	 */
	public $secure_controller = FALSE;

	/**
	 * @var  array  Controlls access to certain actions
	 */
	public $secure_actions = FALSE;

	/**
	 * Checks to see if user has view access.
	 *
	 * @return void
	 */
	public function before()
	{
		parent::before();

		// Provide global auth access
		$this->auth = Auth::instance();

		// Give all controllers session access
		$this->session = Session::instance();
		
		// Grab current action
		$action = $this->request->action;

		if (($this->secure_controller !== FALSE AND $this->auth->logged_in($this->secure_controller) === FALSE)
			OR (is_array($this->secure_actions) AND array_key_exists($action, $this->secure_actions)
				AND $this->auth->logged_in($this->secure_actions[$action]) === FALSE))
		{
			if ($this->auth->logged_in())
			{
				// User doesn't have required roles
				$this->request->redirect('user/access_denied');
			}
			else
			{
				// User must logged in first
				$this->request->redirect('user/sign_in');
			}
		}

		if ($this->auto_render)
		{
			// Initialize empty vars
			$this->template->title = '';
			$this->template->content = '';
		}
	}

	public function action_index()
	{
		
	}

} // End Controller_Drillbugs