<?php

namespace app\models;

class User extends \app\core\Model{
    public $user_id;
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

    //update password
    public function updatePassword(){
        $this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
        $SQL = "UPDATE user SET password_hash = :password_hash WHERE user_id = :user_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['password_hash' => $this->password_hash, 'user_id' => $this->user_id]);
    }

    public function getUserByemail($email){
		$SQL = 'SELECT * FROM user WHERE email = :email';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['email'=>$email]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\User');
		return $STMT->fetch();
	}

    //get all users
    public function getUsers()
    {
        $SQL = "SELECT * FROM user";
        $STMT = self::$_connection->query($SQL);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\User');
        return $STMT->fetchAll();
    }

    public function insert(){
		$this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
		$SQL = 'INSERT INTO user(password_hash, first_name, last_name, dob, email) VALUES (:password_hash, :first_name, :last_name, :dob, :email)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['password_hash'=>$this->password_hash, 'first_name' => $this->first_name, 'last_name' => $this->last_name, 'dob' => $this->dob, 'email' => $this->email]);
    }

    //delete user by account id
	public function delete(){
		$SQL = 'DELETE FROM `user` WHERE user_id = :user_id';
        echo "lala".$this->user_id;
		$STMT = self::$_connection->prepare($SQL);
		var_dump($STMT->execute(['user_id'=>$this->user_id]));
	}

    //get account id by user id
    public function getAccountByUserId($user_id){
        $SQL = "SELECT account_id FROM account WHERE user_id = :user_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['user_id' => $user_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Account');
        return $STMT->fetch();
    }
}