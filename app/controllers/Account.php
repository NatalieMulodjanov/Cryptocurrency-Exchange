<?php

namespace app\controllers;

use app\models\Cryptocurrency;
use DateTime;

class Account extends \app\core\Controller
{
    public function index()
    {
        $cryptoModel = new \app\models\Cryptocurrency();
        $cryptos = $cryptoModel->getAllCurrencies();
        $cryptoModel = $cryptos[0];
        $date = date($cryptoModel->last_refreshed);
        $date = new DateTime($date);
        $dateTimeNow = new DateTime();
        // update value of crypto every day
        if ($date->modify('+1 day') < $dateTimeNow) {
            $cryptos = $cryptoModel->updateCurrencyFromApi($cryptos);
        }

        $wallet = new \app\models\Wallet();
        $wallet = $wallet->getWalletsByAccountId($_SESSION['account_id']);

        $cryptoAPI = [];
        $ownedCrypto = [];
        foreach ($cryptos as $crypto) {
            foreach ($wallet as $w) {
                if ($crypto->code == $w->crypto_code) {
                    $ownedCrypto[$crypto->code] = [
                        'name' => $crypto->name,
                        'rate' => $crypto->exchange_rate,
                        'last_refreshed' => $crypto->last_refreshed,
                        'amount_owned' => $w->amount,
                        'coin_logo_path' => $crypto->coin_logo_path,
                    ];
                }
            }
        }

        $favoriteCryptos = new \app\models\Crypto_status();
        $favoriteCryptos = $favoriteCryptos->getAllFavoritesForAccountId($_SESSION['account_id']);
        $favorites = [];

        foreach ($cryptos as $crypto) {
            $cryptoAPI[$crypto->code] = [
                'name' => $crypto->name,
                'rate' => $crypto->exchange_rate,
                'last_refreshed' => $crypto->last_refreshed,
                'coin_logo_path' => $crypto->coin_logo_path
            ];

            foreach ($favoriteCryptos as $favoriteCrypto) {
                if ($crypto->code == $favoriteCrypto->crypto_code) {
                    $favorites[$crypto->code] = [
                        'name' => $crypto->name,
                        'rate' => $crypto->exchange_rate,
                        'last_refreshed' => $crypto->last_refreshed,
                        'coin_logo_path' => $crypto->coin_logo_path
                    ];
                }
            }
        }

        $account = new \app\models\Account();
        $account = $account->getAccountByUserId($_SESSION['user_id']);
        $available_funds_CAD = $account->available_funds_CAD;

        $user = new \app\models\User();
        $user = $user->getUserById($_SESSION['user_id']);
        $user_First_name = $user->first_name;
        $user_Last_name = $user->last_name;

        $total_funds_CAD = $this->getTotalFunds($cryptoAPI, $available_funds_CAD);

        $data = [
            'ownedCrypto' => $ownedCrypto,
            'cryptoAPI' => $cryptoAPI,
            'allCryptos' => $cryptos,
            'available_funds_CAD' => $available_funds_CAD,
            'total_funds_CAD' => $total_funds_CAD,
            'user_First_name' => $user_First_name,
            'user_Last_name' => $user_Last_name,
            'favorites' => $favorites
        ];

        //  var_dump($data);

        if ($user->isAdmin == 0) {
            $this->view('Account/home', $data);
        } else {
            $users = new \app\models\User();
            $users = $users->getUsers();
            $data = $users;
            $this->view('Admin/home', ['users' => $users, 'cryptoAPI' => $cryptoAPI       ]);
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
            $cryptoModel = new \app\models\Cryptocurrency();
            $cryptos = $cryptoModel->getAllCurrencies();

            $account = new \app\models\Account();
            $account = $account->getAccountById($_SESSION['account_id']);

            foreach ($cryptos as $crypto) {
                $cryptoAPI[$crypto->code] = [
                    'name' => $crypto->name,
                    'rate' => $crypto->exchange_rate,
                    'last_refreshed' => $crypto->last_refreshed,
                    'coin_logo_path' => $crypto->coin_logo_path
                ];
            }
            $this->view('Account/addFunds', ['cryptoAPI' => $cryptoAPI, 'available_funds_CAD' => $account->available_funds_CAD]);
        }
    }

    //method to remove funds from account
    public function removeFunds()
    {
        $cryptoModel = new \app\models\Cryptocurrency();
        $cryptos = $cryptoModel->getAllCurrencies();

        $account = new \app\models\Account();
        $account = $account->getAccountById($_SESSION['account_id']);

        foreach ($cryptos as $crypto) {
            $cryptoAPI[$crypto->code] = [
                'name' => $crypto->name,
                'rate' => $crypto->exchange_rate,
                'last_refreshed' => $crypto->last_refreshed,
                'coin_logo_path' => $crypto->coin_logo_path
            ];
        }
        if (isset($_POST['action'])) {
            $amount = $_POST['amount'];
            $account = new \app\models\Account();
            $account = $account->getAccountById($_SESSION['account_id']);
            if ($account->available_funds_CAD >= $amount) {
                $account->removeFunds($amount);
                header('Location:' . BASE . '/account/index');
            } else {
                $this->view('account/removeFunds', ['error' => 'Insufficient funds', 'cryptoAPI' => $cryptoAPI, 'available_funds_CAD' => $account->available_funds_CAD]);
            }
        } else {
            $this->view('Account/removeFunds', ['cryptoAPI' => $cryptoAPI, 'available_funds_CAD' => $account->available_funds_CAD]);
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

        $cryptoAPI = [];
        foreach ($cryptos as $crypto) {
            $cryptoAPI[$crypto->code] = [
                'name' => $crypto->name,
                'rate' => $crypto->exchange_rate,
                'last_refreshed' => $crypto->last_refreshed,
                'coin_logo_path' => $crypto->coin_logo_path
            ];
        }

        if (isset($_POST['action'])) {
            //remove from total cad in account
            $cryptoModel = new \app\models\Cryptocurrency();
            $cryptoModel = $cryptoModel->getCryptocurrencyByCode($_POST['cryptos']);

            if ($_POST['radio'] == "buy") {
                // add to wallet
                if ($account->available_funds_CAD < $_POST['amount']) {
                    $this->view('Account/buyAndSellCrypto', ['cryptoAPI' => $cryptoAPI, 'cryptos' => $cryptos, 'wallets' => $wallets, 'available_funds_CAD' => $available_funds_CAD, 'error' => 'Insufficient funds']);

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
                        $this->view('Account/buyAndSellCrypto', ['cryptoAPI' => $cryptoAPI, 'cryptos' => $cryptos, 'wallets' => $wallets, 'available_funds_CAD' => $available_funds_CAD, 'error' => 'Insufficient coin']);
                        return;
                    }
                }
                // remove from wallet
                $wallet->account_id = $_SESSION['account_id'];
                $wallet->crypto_code = $_POST['cryptos'];
                $wallet->amount = $_POST['amount']; // negative value because selling

                if ($wallet->getWalletByAccountIdAndCryptoCode($_SESSION['account_id'], $_POST['cryptos']) != null) {
                    $wallet->removeFromWallet();
                    $currentWallet = $wallet->getWalletByAccountIdAndCryptoCode($_SESSION['account_id'], $_POST['cryptos']);
                    if ($currentWallet->amount == 0) {
                        $currentWallet->removeWallet();
                    }

                    $account->addFunds($wallet->amount * $cryptoModel->exchange_rate);
                } else {
                    $this->view('Account/buyAndSellCrypto', ['cryptoAPI' => $cryptoAPI, 'cryptos' => $cryptos, 'wallets' => $wallets, 'available_funds_CAD' => $available_funds_CAD, 'error' => 'You cannot remove a coin that you dont own']);
                    return;
                }
            }

            // add to transaction
            $transaction = new \app\models\Transaction();
            $transaction->account_id = $_SESSION['account_id'];
            $transaction->crypto_code = $_POST['cryptos'];
            $transaction->amount = $_POST['radio'] == "buy" ? $wallet->amount : $wallet->amount * -1;
            $transaction->total = $_POST['radio'] == "buy" ? $_POST['amount'] * -1 : $_POST['amount'];
            $transaction->date_time = date('Y-m-d H:i:s');
            $transaction->insert();


            header('Location:' . BASE . '/Account/index');
        } else {

            $this->view('Account/buyAndSellCrypto', ['cryptoAPI' => $cryptoAPI, 'cryptos' => $cryptos, 'wallets' => $wallets, 'available_funds_CAD' => $available_funds_CAD]);
        }
    }

    //get all past transactions
    public function getPastTransactions()
    {
        $transaction = new \app\models\Transaction();
        $transactions = $transaction->getAllTransactionsByAccountId($_SESSION['account_id']);
        $cryptoModel = new \app\models\Cryptocurrency();
        $cryptos = $cryptoModel->getAllCurrencies();
        $cryptoAPI = [];
        foreach ($cryptos as $crypto) {
            $cryptoAPI[$crypto->code] = [
                'name' => $crypto->name,
                'rate' => $crypto->exchange_rate,
                'last_refreshed' => $crypto->last_refreshed,
                'coin_logo_path' => $crypto->coin_logo_path
            ];
        }

        $this->view('Account/viewPastTransaction', ['cryptoAPI'=>$cryptoAPI, 'transactions' => $transactions]);
    }

    //delete user by account id 
    public function deleteUser()
    {
        $cryptoModel = new \app\models\Cryptocurrency();
        $cryptos = $cryptoModel->getAllCurrencies();
        $cryptoAPI = [];
        foreach ($cryptos as $crypto) {
            $cryptoAPI[$crypto->code] = [
                'name' => $crypto->name,
                'rate' => $crypto->exchange_rate,
                'last_refreshed' => $crypto->last_refreshed,
                'coin_logo_path' => $crypto->coin_logo_path
            ];
        }

        $account = new \app\models\Account();
        $account = $account->getAccountById($_SESSION['account_id']);
        $user = new \app\models\User();
        $user = $user->getUserById($account->user_id);

        $wallet = new \app\models\Wallet();
        $wallets = $wallet->getWalletsByAccountId($_SESSION['account_id']);

        $available_funds_CAD = $account->available_funds_CAD;

        if (isset($_POST['action'])) {
            if ($account->available_funds_CAD > 0) {
                $error = "You cannot delete a user with available funds, make sure to deposit all your CAD";
                $this->view('Account/deleteAccount', ['cryptoAPI' => $cryptoAPI, 'wallets' => $wallets, 'available_funds_CAD' => $available_funds_CAD, 'error' => $error]);
                return;
            }
            if (isset($wallets) && $wallets != null) {
                foreach ($wallets as $wallet) {
                    if ($wallet->amount > 0) {
                        $error = "You cannot delete before trading all cryptocurrencies to CAD, please click 'Trade all cryptocurrencies'";
                        $this->view('Account/deleteAccount', ['cryptoAPI' => $cryptoAPI, 'wallets' => $wallets, 'available_funds_CAD' => $available_funds_CAD, 'error' => $error]);
                        return;
                    }
                }
            }
            $user->delete();
            header('Location:' . BASE . '/User/logout');
        } else {
            $this->view('Account/deleteAccount', ['cryptoAPI' => $cryptoAPI, 'wallets' => $wallets, 'available_funds_CAD' => $available_funds_CAD]);
        }
    }

    //trade all coins to CAD
    public function tradeAll()
    {
        $account = new \app\models\Account();
        $account = $account->getAccountById($_SESSION['account_id']);
        $wallet = new \app\models\Wallet();
        $wallets = $wallet->getWalletsByAccountId($_SESSION['account_id']);
        $cryptoModel = new \app\models\Cryptocurrency();
        $transaction = new \app\models\Transaction();


        foreach ($wallets as $wallet) {
            if ($wallet->amount > 0) {
                echo $wallet->amount;
                $wallet->removeFromWallet();
                $cryptoModel = $cryptoModel->getCryptocurrencyByCode($wallet->crypto_code);
                $account->addFunds($wallet->amount * $cryptoModel->exchange_rate);
                $wallet->removeWallet();
                $transaction->account_id = $_SESSION['account_id'];
                $transaction->crypto_code = $wallet->crypto_code;
                $transaction->amount = $wallet->amount * -1;
                $transaction->total = $wallet->amount * $cryptoModel->exchange_rate;
                $transaction->date_time = date('Y-m-d H:i:s');
                $transaction->insert();
            }
        }
        header('Location:' . BASE . '/Account/deleteUser');
    }

    public function withdrawAll()
    {
        $account = new \app\models\Account();
        $account = $account->getAccountById($_SESSION['account_id']);
        if ($account->available_funds_CAD > 0) {
            $account->removeFunds($account->available_funds_CAD);
            // cannot add a transaction without crypto_id, this is worthless
            // $transaction = new \app\models\Transaction();
            // $transaction->account_id = $_SESSION['account_id'];
            // $transaction->crypto_code = null;
            // $transaction->amount = 0;
            // $transaction->total = $account->available_funds_CAD;
            // $transaction->date_time = date('Y-m-d H:i:s');
            // $transaction->insert();
        }

        header('Location:' . BASE . '/Account/deleteUser');
    }

    //get referral code from account
    public function getReferral()
    {
        $cryptoModel = new \app\models\Cryptocurrency();
        $cryptos = $cryptoModel->getAllCurrencies();
        $cryptoAPI = [];
        foreach ($cryptos as $crypto) {
            $cryptoAPI[$crypto->code] = [
                'name' => $crypto->name,
                'rate' => $crypto->exchange_rate,
                'last_refreshed' => $crypto->last_refreshed,
                'coin_logo_path' => $crypto->coin_logo_path
            ];
        }

        $account = new \app\models\Account();
        $account = $account->getAccountById($_SESSION['account_id']);
        $referral = $account->referral_code;
        $this->view('Account/getReferral', ['referral'=> $referral, 'cryptoAPI' => $cryptoAPI]);
    }
}
