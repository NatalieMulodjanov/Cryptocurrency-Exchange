<?php

namespace app\models;

class Wallet extends \app\core\Model
{
    public $account_id;
    public $crypto_code;
    public $amount;

    public function __construct()
    {
        parent::__construct();
    }

    //insert into wallet 
    public function addWallet()
    {
        $SQL = "INSERT INTO wallet (account_id, crypto_code, amount) VALUES (:account_id, :crypto_code, :amount)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['account_id' => $this->account_id,'crypto_code' => $this->crypto_code,'amount' => $this->amount]);
    }

    //update wallet
    public function addToWallet()
    {
        $SQL = "UPDATE wallet SET amount = amount + :amount WHERE account_id = :account_id AND crypto_code = :crypto_code";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['account_id' => $this->account_id,'crypto_code' => $this->crypto_code,'amount' => $this->amount]);
    }

    public function removeFromWallet() {
        $SQL = "UPDATE wallet SET amount = amount - :amount WHERE account_id = :account_id AND crypto_code = :crypto_code";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['account_id' => $this->account_id,'crypto_code' => $this->crypto_code,'amount' => $this->amount]);
    }

    public function removeWallet() {
        $SQL = "DELETE FROM wallet WHERE account_id = :account_id AND crypto_code = :crypto_code";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['account_id' => $this->account_id,'crypto_code' => $this->crypto_code]);
    }

    //get all wallets by account id
    public function getWalletsByAccountId($account_id)
    {
        $SQL = "SELECT * FROM wallet WHERE account_id = :account_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['account_id' => $account_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Wallet');
        return $STMT->fetchAll();
    }

    //get wallet by account id and crypto id
    public function getWalletByAccountIdAndCryptoCode($account_id, $code)
    {
        $SQL = "SELECT * FROM wallet WHERE account_id = :account_id AND crypto_code = :crypto_code";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['account_id' => $account_id,'crypto_code' => $code]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Wallet');
        return $STMT->fetch();
    }

}
