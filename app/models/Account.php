<?php 
namespace app\models;

class Account extends \app\core\Model{
    public $account_id;
    public $total_funds_CAD;
    public $referral_code;
    public $user_id;

    public function __construct(){
        parent::__construct();
    }
}