<?php

namespace app\models;

class Transaction extends \app\core\Model
{
    public $transaction_id;
    public $account_id;
    public $crypto_id;
    public $amount; //amount of crypto bought e.g 0.05 eth 
    public $total; //total amount of cad spent e.g 3000 cad 
    public $date_time;

    public function __construct()
    {
        parent::__construct();
    }

    //make transaction 
    public function insert(){
        $SQL = "INSERT INTO transaction (account_id, crypto_id, amount, total, date_time) VALUES (:account_id, :crypto_id, :amount, :total, :date_time)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute([':account_id' => $this->account_id,':crypto_id' => $this->crypto_id,':amount' => $this->amount,':total' => $this->total,':date_time' => $this->date_time]);
    }
}
