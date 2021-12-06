<?php

namespace app\controllers;

use app\models\Cryptocurrency;

class Account extends \app\core\Controller
{
    public function index()
    {
        $cryptoModel = new \app\models\Cryptocurrency();
        $cryptos = $cryptoModel->getAllCurrencies();
        $cryptoModel = $cryptos[0];
        
        if (date($cryptoModel->last_refreshed, strtotime("+24 Hours")) > date('Y-m-d H:i:s')) {
            echo "here";
            var_dump(date($cryptoModel->last_refreshed, strtotime("+24 Hours")));
            var_dump(date('Y-m-d H:i:s'));
            $cryptos = $cryptoModel->updateCurrencyFromApi($cryptos);
        }
        // var_dump($cryptos);
        $cryptoAPI = [];
        foreach ($cryptos as $crypto) {
            $cryptoAPI[$crypto->code] = [
                'name' => $crypto->name,
                'rate' => $crypto->exchange_rate,
                'last_refreshed' => $crypto->last_refreshed
            ];
        }
        $account = new \app\models\Account();
        $account = $account->getAccountByUserId($_SESSION['user_id']);
        $total_funds_CAD = $account->total_funds_CAD;

        $user = new \app\models\User();
        $user = $user->getUserById($_SESSION['user_id']);
        $user_First_name = $user->first_name;
        $user_Last_name = $user->last_name;

        $total_funds_CAD = $this->getTotalFunds($cryptoAPI, $total_funds_CAD);

        $data = [
            'cryptoAPI' => $cryptoAPI,
            'total_funds_CAD' => $total_funds_CAD,
            'user_First_name' => $user_First_name,
            'user_Last_name' => $user_Last_name
        ];

        //  var_dump($data);

        $this->view('Account/home', $data);
    }
    //method to add funds into account 
    public function addFunds()
    {
        if (isset($_POST['action'])) {
            $amount = $_POST['amount'];
            $account = new \app\models\Account();
            echo $_SESSION['account_id'];
            $account = $account->getAccountById($_SESSION['account_id']);
            $account->addFunds($amount);
            header('Location:' . BASE . '/account/index');
        } else {
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
            $this->view('Account/removeFunds',);
        }
    }

    //get total funds from account and wallet
    private function getTotalFunds($cryptos, $total_funds_CAD)
    {

        $wallet = new \app\models\Wallet();
        $wallets = $wallet->getWalletsByAccountId($_SESSION['account_id']);
        $cryptocurrency = new \app\models\Cryptocurrency();

        foreach ($wallets as $wallet) {
            $cryptocurrency = $cryptocurrency->getCryptocurrencyById($wallet->crypto_id);
            $crypto_code = $cryptocurrency->crypto_code;
            $amount_CAD = $wallet->amount * $cryptos[$crypto_code]['rate'];

            $total_funds_CAD += $amount_CAD;
        }
        return $total_funds_CAD;
    }

    //buy crypto
    public function buy()
    {
        if (isset($_POST['action'])) {
            //remove from total cad in account
            $account = new \app\models\Account();
            $account = $account->getAccountById($_SESSION['account_id']);
            $account->removeFunds($_POST['amount']);

            // add to wallet
            $wallet = new \app\models\Wallet();
            $wallet->account_id = $_SESSION['account_id'];
            $wallet->crypto_id = $_POST['crypto_id'];
            $wallet->amount = $_POST['amount']; // exchange rate;
            $wallet->addWallet();

            // add to transaction
            $transaction = new \app\models\Transaction();
            $transaction->account_id = $_SESSION['account_id'];
            $transaction->crypto_id = $_POST['crypto_id'];
            $transaction->amount = $_POST['amount']; // exchange rate;
            $transaction->total = $_POST['amount'];
            $transaction->date_time = date('Y-m-d H:i:s');
            $transaction->insert();

            header('Location:' . BASE . '/Account/index');
        } else {
            $this->view('Account/buyCrypto');
        }
    }
}
