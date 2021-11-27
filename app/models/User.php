<?php

namespace app\models;

class User extends \app\core\Model{
    public $user_id;
    public $username;
    public $password;
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
    public function get($username){
		$SQL = 'SELECT * FROM user WHERE username = :username';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['username'=>$username]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\User');
		return $STMT->fetch();
	}

    public function insert(){
		$this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
		$SQL = 'INSERT INTO user(username, password_hash) VALUES (:username, :password_hash)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['username'=>$this->username,'password_hash'=>$this->password_hash]);
	}

	public function delete($user_id){
		$SQL = 'DELETE FROM `user` WHERE user_id = :user_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$user_id]);
	}
}