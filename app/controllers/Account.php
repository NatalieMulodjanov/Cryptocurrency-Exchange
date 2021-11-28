<?php

namespace app\controllers;

use app\models\Cryptocurrency;

class Account extends \app\core\Controller
{
    public function index()
    {
        $cryptoModel = new \app\models\Cryptocurrency();
        $cryptos = $cryptoModel->getAllCurrencyExchangeRates();
        $cryptoAPI = [];
        foreach($cryptos as $crypto){
            $baseObject = $crypto['Realtime Currency Exchange Rate'];
            $crypto_code = $baseObject["1. From_Currency Code"];
            $crypto_name = $baseObject["2. From_Currency Name"];
            $exchange_rate_cad = $baseObject["5. Exchange Rate"];
            $last_refreshed = $baseObject["6. Last Refreshed"];
            $cryptoAPI[] = [
                'code' => $crypto_code,
                'name' => $crypto_name,
                'rate' => $exchange_rate_cad,
                'last_refreshed' => $last_refreshed
            ];
        }

        var_dump($cryptoAPI);

        
        $this->view('Account/home', $cryptoAPI);
    }
    //method to add funds into account 
    public function addFunds()
    {
        if (isset($_POST['action'])) {
            $amount = $_POST['amount'];
            $account = new \app\models\Account();
            $account = $account->getAccountById($_SESSION['account_id']);
            $account->addFunds($amount);
            header('Location:' . BASE . '/account/index');
        } else {
            //TODO: get session variable in login 
            $_SESSION['account_id'] = 1;
            $this->view('Account/addFunds');
        }
    }

    //method to remove funds from account
    public function removeFunds()
    {
        if (isset($_POST['action'])) {
            $amount = $_POST['amount'];
            $account = new \app\models\Account();
            $account = $account->getAccountById($_SESSION['account_id']);
            if ($account->total_funds_CAD >= $amount) {
                $account->removeFunds($amount);
                header('Location:' . BASE . '/account/index');
            } else {
                $this->view('account/removeFunds', ['error' => 'Insufficient funds']);
            }
        } else {
            //TODO: get session variable in login 
            $_SESSION['account_id'] = 1;
            $this->view('Account/removeFunds', );
        }
    }
}
