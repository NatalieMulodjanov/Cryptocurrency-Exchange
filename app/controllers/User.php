<?php
namespace app\controllers;

class User extends \app\core\Controller
{
    public function index()
    {
       $this->view('Account/home');
    }

    public function settings()
    {
        $this->view('User/settings');
    }

    //TODO: do not forget to change user id to session variable user id
    public function editPersonalInfo(){
        $user = new \app\models\User();
        $user = $user->getUserById(1);
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

  
}