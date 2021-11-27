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

  

    //get user by user id
    public function getUserById($user_id){
        $SQL = "SELECT * FROM user WHERE user_id = :user_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['user_id' => $user_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\User');
        return $STMT->fetch();
    }

    //update user
    public function update(){
        $SQL = "UPDATE user SET first_name = :first_name, last_name = :last_name, dob = :dob, email = :email WHERE user_id = :user_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['first_name' => $this->first_name, 'last_name' => $this->last_name, 'dob' => $this->dob, 'email' => $this->email, 'user_id' => $this->user_id]);
    }
}