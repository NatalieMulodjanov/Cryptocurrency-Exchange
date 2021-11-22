<?php

namespace app\controllers;

class Account extends \app\core\Controller
{

    public function index(){
        $this->view->render('account/index');
    }

    public function addFunds()
    {
        if (isset($_POST['action'])){
            $amount = $_POST['amount'];
            $account = new \app\models\Account();
            $account = $account->getAccountById($_SESSION['account_id']);
            $account->addFunds($amount);
            echo "funds added successfully";
        } else {
            $_SESSION['account_id'] = 1;
            $this->view('Account/addFunds');
        }
        
    }
}
