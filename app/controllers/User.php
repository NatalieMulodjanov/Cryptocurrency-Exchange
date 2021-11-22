<?php
namespace app\controllers;

class User extends \app\core\Controller
{
    public function index()
    {
        header('location:' . BASE . 'User/login');
    }

    public function login()
	{
		if (isset($_POST['action'])) {
			$user = new \app\models\User();
			$user = $user->get($_POST['username']);
			if ($user != false && password_verify($_POST['password'], $user->password_hash)) {
				$_SESSION['user_id'] = $user->user_id;
				$_SESSION['username'] = $user->username;
				header('location:' . BASE . 'Account/index');
			} else {
				$this->view('User/login', 'Wrong username and password combination!');
			}
		} else
			$this->view('User/login');
	}
  
    public function register()
	{
		if (isset($_POST['action']) && $_POST['password'] == $_POST['password_confirm']) {
			$user = new \app\models\User();
			if ($user->get($_POST['username']) == false) {
				$user->username = $_POST['username'];
				$user->password = $_POST['password'];
				$user->insert();
				header('location:' . BASE . 'User/login');
			}
		} else
			$this->view('User/register');
	}

    #[\app\filters\Login]
	public function logout()
	{
		session_destroy();
		header('location:' . BASE . 'User/login');
	}
}