<?php

namespace app\models;

class Wallet extends \app\core\Model
{
    public $account_id;
    public $crypto_id;
    public $amount;

    public function __construct()
    {
        parent::__construct();
    }

    //insert into wallet 
    public function addWallet()
    {
        $SQL = "INSERT INTO wallet (account_id, crypto_id, amount) VALUES (:account_id, :crypto_id, :amount)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['account_id' => $this->account_id,'crypto_id' => $this->crypto_id,'amount' => $this->amount]);
    }

    //get all wallets by user id
    public function getWalletsByAccountId($account_id)
    {
        $SQL = "SELECT * FROM wallet WHERE account_id = :account_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['account_id' => $account_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Wallet');
        return $STMT->fetchAll();
    }
}
