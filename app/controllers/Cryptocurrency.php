<?php
namespace app\controllers;

class Cryptocurrency extends \app\core\Controller
{
    public function addCrypto(){
        if (isset($_POST['action'])) {
            $crypto = new \app\models\Cryptocurrency();
            $crypto->name = $_POST['name'];
            $crypto->code = $_POST['code'];
            $crypto->exchange_rate = $_POST['exchange_rate'];
            $crypto->last_refreshed = date('Y-m-d H:i:s');
            $crypto->insertCryptocurrency();
            header('Location:' . BASE . '/Admin/home');
        } else {
            $this->view('Admin/addCrypto');
        }
    }
}