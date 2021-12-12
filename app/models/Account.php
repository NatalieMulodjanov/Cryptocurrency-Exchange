<?php

namespace app\models;

class Account extends \app\core\Model
{
    public $account_id;
    public $available_funds_CAD;
    public $referral_code;
    public $user_id;

    public function __construct()
    {
        parent::__construct();
    }

    // add funds to wallet
    public function addFunds($amount)
    {
        $SQL = "UPDATE account SET available_funds_CAD = CONVERT(available_funds_CAD, DECIMAL) + CONVERT(:amount ,DECIMAL) WHERE account_id = :account_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['amount' => $amount, 'account_id' => $this->account_id]);
    }

    // remove funds from cad
    public function removeFunds($amount)
    {
        $SQL = "UPDATE account SET available_funds_CAD = CONVERT(:available_funds_CAD, DECIMAL) - CONVERT(:amount, DECIMAL) WHERE account_id = :account_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['available_funds_CAD' => $this->available_funds_CAD , 'amount' => $amount, 'account_id' => $this->account_id]);
    }

    //get account by account id
    public function getAccountById($account_id)
    {
        $SQL = "SELECT * FROM account WHERE account_id = :account_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['account_id' => $account_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Account');
        return $STMT->fetch();
    }

    //get account by user id
    public function getAccountByUserId($user_id)
    {
        $SQL = "SELECT * FROM account WHERE user_id = :user_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['user_id' => $user_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Account');
        return $STMT->fetch();
    }

    //get all accounts
    public function getAccounts()
    {
        $SQL = "SELECT * FROM account";
        $STMT = self::$_connection->query($SQL);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Account');
        return $STMT->fetchAll();
    }

    //insert into account
    public function insert()
    {
        $SQL = "INSERT INTO account (available_funds_CAD, referral_code, user_id) VALUES (:available_funds_CAD, :referral_code, :user_id)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['available_funds_CAD' => $this->available_funds_CAD, 'referral_code' => $this->referral_code, 'user_id' => $this->user_id]);
    }

	
}
