<?php

namespace app\models;

class Cryptocurrency extends \app\core\Model
{
    public $crypto_id;
    public $name;
    public $code;
    public $exchange_rate;
    public $last_refreshed;

    public function __construct()
    {
        parent::__construct();
    }

    //add cryptocurrency
    // TODO: check api 
    public function insertCryptocurrency()
    {
        $SQL = "INSERT INTO cryptocurrency (name, code, exchange_rate, last_refreshed) VALUES (:name, :code, :exhange_rate, :last_refreshed)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['name' => $this->name, 'code' => $this->code, 'exchange_rate' => $this->exchange_rate, 'last_refreshed' => $this->last_refreshed]);
    }

    public function updateCryptocurrency()
    {
        $SQL = "UPDATE cryptocurrency SET exchange_rate = :exchange_rate, last_refreshed = :last_refreshed WHERE crypto_id = :crypto_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['exchange_rate' => $this->exchange_rate, 'last_refreshed' => $this->last_refreshed, 'crypto_id' => $this->crypto_id]);
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
    public function updateCurrencyFromApi($cryptos){
        $results = [];
        foreach($cryptos as $currency){
            $url = "https://alpha-vantage.p.rapidapi.com/query?from_currency=".$currency->code."&to_currency=CAD&function=CURRENCY_EXCHANGE_RATE";
            $result = $this->callAPI('GET', $url);
            $result = json_decode($result, true);
            $currency->last_refreshed = date('Y-m-d H:i:s');
            $currency->exchange_rate = $result['Realtime Currency Exchange Rate']['5. Exchange Rate'];
            $currency->updateCryptocurrency();
            $results[] = $currency;
        }
    }

    //get all currencies from db
    public function getAllCurrencies(){
        $SQL = "SELECT * FROM cryptocurrency";
        $STMT = self::$_connection->query($SQL);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Cryptocurrency');
        $result = $STMT->fetchAll();
        return $result;
    }

    //get currency by id 
    public function getCryptocurrencyById($crypto_id){
        $SQL = "SELECT * FROM cryptocurrency WHERE crypto_id = :crypto_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['crypto_id' => $crypto_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Cryptocurrency');
        $result = $STMT->fetch();
        return $result;
    }

    public function getCryptocurrencyByCode($crypto_code){
        $SQL = "SELECT * FROM cryptocurrency WHERE code = :crypto_code";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['crypto_code' => $crypto_code]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Cryptocurrency');
        $result = $STMT->fetch();
        return $result;
    }
}
