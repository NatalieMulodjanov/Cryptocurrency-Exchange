<?php

namespace app\models;

class User extends \app\core\Model{
    public $user_id;
    public $password_hash;
    public $first_name;
    public $last_name;
    public $dob; 
    public $two_factor_authentication_token;
    public $email;
    public $isAdmin;

    public function __construct(){
        parent::__construct();
    }
}