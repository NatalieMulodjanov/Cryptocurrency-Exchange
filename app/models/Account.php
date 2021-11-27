<?php

namespace app\models;

class Account extends \app\core\Model
{
    public $account_id;
    public $total_funds_CAD;
    public $referral_code;
    public $user_id;

    public function __construct()
    {
        parent::__construct();
    }

    // add funds to wallet
    public function addFunds($amount)
    {
        $SQL = "UPDATE account SET total_funds_CAD = CONVERT(:total_funds_CAD, DECIMAL) + CONVERT(:amount ,DECIMAL) WHERE account_id = :account_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['total_funds_CAD' => $this->total_funds_CAD , 'amount' => $amount, 'account_id' => $this->account_id]);
    }

    // remove funds from wallet
    public function removeFunds($amount)
    {
        $SQL = "UPDATE account SET total_funds_CAD = CONVERT(:total_funds_CAD, DECIMAL) - CONVERT(:amount, DECIMAL) WHERE account_id = :account_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['total_funds_CAD' => $this->total_funds_CAD , 'amount' => $amount, 'account_id' => $this->account_id]);
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
}
