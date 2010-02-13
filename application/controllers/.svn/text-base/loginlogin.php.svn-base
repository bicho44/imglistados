<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Made by:
 * Remorse.nl
 */
class Login_Controller extends Controller {
	// Do not allow to run in production
	const ALLOW_PRODUCTION = FALSE;
	public function index()
	{
		//just redirect
		url::redirect('login/login');
	}
	public function create()
	{
		echo '
			Create form:<br>
			<form method="post" action="'.url::base().'login_test/create">
			email:<input type="text" name="email"><br>
			name:<input type="text" name="username"><br>
			pass:<input type="text" name="password"><br>
			<input type="submit" value="create">
			</form>
		';
		//get the post data
		$form = $_POST;
		// Create new user
		$user = ORM::factory('user');
		//set all the form field in the user class
		//so that we can use $user->save() that inserts a new record to the db
		//html form-field names must be exactly the same as the db-column names
		foreach ($form as $key => $val){
			$user->$key = $val;
		}
		//ORM::factory('role', 'login') returns orm object and get's value from colum with name=login
		//$user->add makes a relation between $user and role orm model returned by ORM::factory('role', 'login')
		if ($user->save() AND $user->add(ORM::factory('role', 'login')))
		{
							  //login($username,$password)
			Auth::instance()->login($form['username'], $form['password']);
			//could also be like this:
			//Auth::instance()->login($user, $form['password']);
			// Redirect to the login page
			url::redirect('login_test/login');
		}
	}
	public function login()
	{
		// user is logged in....
		if (Auth::instance()->logged_in())
		{
			echo 'u are logged in.... <a href="'.url::base().'login/logout">Logout</a>';
		}
		else
		{
			echo '
				<a href="'.url::base().'login_test/create">Click here to create a user</a><br><br>
				Login form:<br>
				<form method="post" action="'.url::base().'login_test/login">
				name:<input type="text" name="username"><br>
				pass:<input type="text" name="password"><br>
				<input type="submit" value="login">
				</form>
			';
			$form = $_POST;
			if($form){
				// Load the user
				$user = ORM::factory('user', $form['username']);
				// orm user object or $form['username'] could be used
				if (Auth::instance()->login($user, $form['password']))
				{
					// Login successful, redirect
					// or do some other things u like
					url::redirect('login_test/login');
				}
				else
				{
					echo 'login_failed Invalid username or password.';
				}
			}
		}
	}
	public function logout()
	{
		// Force a complete logout
		Auth::instance()->logout(TRUE);
		// Redirect back to the login page
		url::redirect('login_test/login');
	}
} // End Auth Controller