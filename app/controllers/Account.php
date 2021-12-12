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
        $available_funds_CAD = $account->available_funds_CAD;

        $user = new \app\models\User();
        $user = $user->getUserById($_SESSION['user_id']);
        $user_First_name = $user->first_name;
        $user_Last_name = $user->last_name;

        $available_funds_CAD = $this->getTotalFunds($cryptoAPI, $available_funds_CAD);

        $data = [
            'cryptoAPI' => $cryptoAPI,
            'available_funds_CAD' => $available_funds_CAD,
            'user_First_name' => $user_First_name,
            'user_Last_name' => $user_Last_name
        ];

        //  var_dump($data);

        if($user->isAdmin == 0){
            $this->view('Account/home', $data);
        }else{
            $users = new \app\models\User();
            $users = $users->getUsers();
            $data = $users;
            $this->view('Admin/home', $data);
        }
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
            if ($account->available_funds_CAD >= $amount) {
                $account->removeFunds($amount);
                header('Location:' . BASE . '/account/index');
            } else {
                $this->view('account/removeFunds', ['error' => 'Insufficient funds']);
            }
        } else {
            //TODO: get session variable in login 
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
            $cryptocurrency = $cryptocurrency->getCryptocurrencyByCode($wallet->crypto_code);
            $amount_CAD = $wallet->amount * $cryptocurrency->exchange_rate;

            $total_funds_CAD += $amount_CAD;
        }
        return $total_funds_CAD;
    }

    //buy crypto
    public function buyCrypto()
    {
        $wallet = new \app\models\Wallet();
        $account = new \app\models\Account();
        $account = $account->getAccountById($_SESSION['account_id']);
        $cryptoModel = new \app\models\Cryptocurrency();
        $cryptos = $cryptoModel->getAllCurrencies();
        $wallets = $wallet->getWalletsByAccountId($_SESSION['account_id']);
        $available_funds_CAD = $account->available_funds_CAD;

        if (isset($_POST['action'])) {
            //remove from total cad in account
            $cryptoModel = new \app\models\Cryptocurrency();
            $cryptoModel = $cryptoModel->getCryptocurrencyByCode($_POST['cryptos']);

            if ($_POST['radio'] == "buy") {
                // add to wallet
                if ($account->available_funds_CAD < $_POST['amount']) {
                    $this->view('Account/buyAndSellCrypto', ['cryptos' => $cryptos, 'wallets' => $wallets, 'available_funds_CAD' => $available_funds_CAD, 'error' => 'Insufficient funds']);

                    return;
                }
                $wallet->account_id = $_SESSION['account_id'];
                $wallet->crypto_code = $_POST['cryptos'];
                $wallet->amount = $_POST['amount'] / $cryptoModel->exchange_rate; // exchange rate;
                // Buy flow
                if ($wallet->getWalletsByAccountId($_SESSION['account_id']) == null) {
                    $wallet->addWallet();
                } else if ($wallet->getWalletByAccountIdAndCryptoCode($_SESSION['account_id'], $_POST['cryptos']) != null) {
                    $wallet->addToWallet();
                } else {
                    $wallet->addWallet();
                }
                // remove cad from account
                $account->removeFunds($_POST['amount']);
            } else {
                if ($wallet->getWalletByAccountIdAndCryptoCode($_SESSION['account_id'], $_POST['cryptos']) != null) {
                    if ($wallet->getWalletByAccountIdAndCryptoCode($_SESSION['account_id'], $_POST['cryptos'])->amount < $_POST['amount']) {
                        $this->view('Account/buyAndSellCrypto', ['cryptos' => $cryptos, 'wallets' => $wallets, 'available_funds_CAD' => $available_funds_CAD, 'error' => 'Insufficient coin']);
                        return;
                    }
                }
                // remove from wallet
                $wallet->account_id = $_SESSION['account_id'];
                $wallet->crypto_code = $_POST['cryptos'];
                $wallet->amount = $_POST['amount']; // negative value because selling

                if ($wallet->getWalletByAccountIdAndCryptoCode($_SESSION['account_id'], $_POST['cryptos']) != null) {
                    $wallet->removeFromWallet();
                    $account->addFunds($wallet->amount * $cryptoModel->exchange_rate);
                    $wallet->amount *= -1;
                } else {
                    echo "You cannot remove a coin that you dont own";
                }
            }

            // add to transaction
            $transaction = new \app\models\Transaction();
            $transaction->account_id = $_SESSION['account_id'];
            $transaction->crypto_code = $_POST['cryptos'];
            $transaction->amount = $wallet->amount;
            $transaction->total = $_POST['amount'];
            $transaction->date_time = date('Y-m-d H:i:s');
            $transaction->insert();


            header('Location:' . BASE . '/Account/index');
        } else {

            $this->view('Account/buyAndSellCrypto', ['cryptos' => $cryptos, 'wallets' => $wallets, 'available_funds_CAD' => $available_funds_CAD]);
        }
    }

    //get referral code from account
    public function getReferral()
    {
        $account = new \app\models\Account();
        $account = $account->getAccountById($_SESSION['account_id']);
        $referral = $account->referral_code;
        $this->view('Account/getReferral', $referral);
    }
}
