<?php

namespace app\models;

class User extends \app\core\Model{
    public $user_id;
    public $email;
    public $password_hash;
    public $refferal_code;
    public $first_name;
    public $last_name;
    public $dob; 
    public $total_funds;

    public function __construct(){
        parent::__construct();
    }
}