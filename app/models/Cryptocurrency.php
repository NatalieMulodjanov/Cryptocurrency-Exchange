<?php

namespace app\models;

class Cryptocurrency extends \app\core\Model
{
    public $crypto_id;
    public $name;
    public $code;

    public function __construct()
    {
        parent::__construct();
    }

    //add cryptocurrency
    // TODO: check api 
    public function insertCryptocurrency()
    {
        $SQL = "INSERT INTO cryptocurrency (name, code) VALUES (:name, :code)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['name' => $this->name, 'code' => $this->code]);
    }

    function callAPI($method, $url, $data = null)
    {
        $curl = curl_init();

        switch ($method) {
            case "GET":
                curl_setopt($curl, CURLOPT_HTTPGET, 1);
                break;
        }

        // Optional Authentication:
        $apiKey = "31e07079c9mshc35c49be1404043p15a716jsn30a68abea982";
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'x-rapidapi-key: '.$apiKey,
        ));
        // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

    //get all currencies from api
    public function getAllCurrencyExchangeRates(){
        $allowedCurrencies = $this->getAllCurrencies();
        $results = [];
        foreach($allowedCurrencies as $currency){
            $url = "https://alpha-vantage.p.rapidapi.com/query?from_currency=".$currency->code."&to_currency=CAD&function=CURRENCY_EXCHANGE_RATE";
            $result = $this->callAPI('GET', $url);
            $result = json_decode($result, true);
            $results[] = $result;
        }
        return $results;
    }

    //get all currencies from db
    public function getAllCurrencies(){
        $SQL = "SELECT * FROM cryptocurrency";
        $STMT = self::$_connection->query($SQL);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Cryptocurrency');
        $result = $STMT->fetchAll();
        return $result;
    }
}
