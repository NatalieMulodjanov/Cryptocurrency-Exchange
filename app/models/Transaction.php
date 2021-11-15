<?php

namespace app\models;

class Transaction extends \app\core\Model
{
    public $transaction_id;
    public $account_id;
    public $crypto_id;
    public $amount;
    public $total;
    public $date_time;

    public function __construct()
    {
        parent::__construct();
    }
}
