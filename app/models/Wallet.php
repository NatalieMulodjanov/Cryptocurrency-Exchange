<?php

namespace app\models;

class Wallet extends \app\core\Model
{
    public $user_ud;
    public $crypto_id;
    public $amount;

    public function __construct()
    {
        parent::__construct();
    }
}
