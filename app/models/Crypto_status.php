<?php
namespace app\models;

class Crypto_status extends \app\core\Model{
    public $user_id;
    public $crypto_id;
    public $status;

    public function __construct(){
        parent::__construct();
    }

}