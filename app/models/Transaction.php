<?php

namespace app\models;

class Transaction extends \app\core\Model
{
    public $transaction_id;
    public $account_id;
    public $crypto_code;
    public $amount; //amount of crypto bought e.g 0.05 eth 
    public $total; //total amount of cad spent e.g 3000 cad 
    public $date_time;

    public function __construct()
    {
        parent::__construct();
    }

    //make transaction 
    public function insert(){
        $SQL = "INSERT INTO transaction (account_id, crypto_code, amount, total, date_time) VALUES (:account_id, :crypto_code, :amount, :total, :date_time)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute([':account_id' => $this->account_id,':crypto_code' => $this->crypto_code,':amount' => $this->amount,':total' => $this->total,':date_time' => $this->date_time]);
    }

    //get all transactions by account id
    public function getAllTransactionsByAccountId($account_id){
        $SQL = "SELECT * FROM transaction WHERE account_id = :account_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute([':account_id' => $account_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Transaction');
        return $STMT->fetchAll();
    }
}
