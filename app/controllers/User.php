<?php
namespace app\controllers;

class User extends \app\core\Controller
{
	#[\app\filters\Login]
    public function index()
    {
       header('Location:' . BASE . '/Account/home');
    }

    public function settings()
    {
        $this->view('User/settings');
    }

    public function editPersonalInfo(){
        $user = new \app\models\User();
        $user = $user->getUserById($_SESSION['user_id']);
        if (isset($_POST['action'])) {
            $user->first_name = $_POST['first_name'];
            $user->last_name = $_POST['last_name'];
            $user->dob = $_POST['dob'];
            $user->email = $_POST['email'];
            $user->update();
            header('Location:' . BASE . '/user/editPersonalInfo');
        } else {
            $this->view('User/editPersonalInfo', $user);
        }
    }

	public function editPassword(){
        if (isset($_POST['action'])) {
			if ($_POST['password'] == $_POST['password_confirm']){
				$user = new \app\models\User();
        		$user = $user->getUserByemail($_POST['email']);
				$user->password = $_POST['password'];
            	$user->updatePassword();
            	header('Location:' . BASE . '/User/login');
			} else{
				$this->view('User/editPassword', ['error' =>'Password not confirmed!']);
			}
        } else {
            $this->view('User/editPassword');
        }
    }

    public function login()
	{
		if (isset($_POST['action'])) {
			$user = new \app\models\User();
			$user = $user->getUserByEmail($_POST['email']);
			if ($user != false && password_verify($_POST['password'], $user->password_hash)) {
				$_SESSION['user_id'] = $user->user_id;
				$_SESSION['email'] = $user->email;
				$_SESSION['account_id'] = $user->getAccountByUserId($user->user_id)->account_id;
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
			$account = new \app\models\Account();
			if ($user->getUserByEmail($_POST['email']) == false) {
				$user->first_name = $_POST['first_name'];
				$user->last_name = $_POST['last_name'];
				$user->dob = $_POST['dob'];
				$user->email = $_POST['email'];
				$user->password = $_POST['password'];
				$user->insert();
				$user = $user->getUserByEmail($_POST['email']);
				$account->referral_code = random_int(1000, 9999);
				$referral = $_POST['referral_code'];
				$accounts = new \app\models\Account();
				$accounts = $accounts->getAccounts();
				$addFund = false;
				foreach($accounts as $account2){
					if($account2->referral_code == $referral){
						$account2->addFunds(25);
						$addFund = true;
					}
				}
				if($addFund){
					$account->available_funds_CAD = 25;
				} else{
					$account->available_funds_CAD = 0;
				}
				$account->user_id = $user->user_id;
				$account->insert();
				header('location:' . BASE . 'User/login');
			} else {
				$this->view('User/register', ['error' =>'Email already exists!']);
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

	//delete user
	public function delete($user_id){
		$user = new \app\models\User;
		$user->delete($user_id);
		header('location:' . BASE . 'Account/index');
	}
}