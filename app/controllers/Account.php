<?php

namespace app\controllers;

class Account extends \app\core\Controller
{
    public function index()
    {
        $this->view('Account/home');
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
