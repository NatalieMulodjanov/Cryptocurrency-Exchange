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
            $crypto->coin_logo_path = $_POST['coin_logo_path'];
            $crypto->last_refreshed = date('Y-m-d H:i:s');
            $crypto->insertCryptocurrency();
            header('Location:' . BASE . '/Admin/home');
        } else {
            $this->view('Admin/addCrypto');
        }
    }

    public function addFavorite($crypto_code) {
        $crypto_status = new \app\models\Crypto_status();
        $crypto_status->account_id = $_SESSION['account_id'];
        $crypto_status->crypto_code = $crypto_code;
        $crypto_status->insertFavorite();

        header('Location:' . BASE . '/Account/index');
    }

    public function removeFavorite($crypto_code) {
        $crypto_status = new \app\models\Crypto_status();
        $crypto_status->account_id = $_SESSION['account_id'];
        $crypto_status->crypto_code = $crypto_code;
        $crypto_status->removeFavorite();

        header('Location:' . BASE . '/Account/index');
    }
}