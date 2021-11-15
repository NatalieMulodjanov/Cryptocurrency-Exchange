<?php
namespace app\models;

class Cryptocurrency extends \app\core\Model{
    public $crypto_id;
    public $name;
    public $value;

    public function __construct(){
        parent::__construct();
    }


}