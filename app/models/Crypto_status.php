<?php
namespace app\models;

class Crypto_status extends \app\core\Model{
    public $account_id;
    public $crypto_code;
    public $status;

    public function __construct(){
        parent::__construct();
    }


    public function insertFavorite() {
        $SQL = "INSERT INTO crypto_status (account_id, crypto_code, status) VALUES (:account_id, :crypto_code, 'favorite')";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['account_id' => $this->account_id, 'crypto_code' => $this->crypto_code]);
    }

    public function getAllFavoritesForAccountId($account_id) {
        $SQL = "SELECT * FROM crypto_status WHERE account_id = :account_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['account_id' => $account_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Crypto_status');
        return $STMT->fetchAll();
    }

    public function removeFavorite() {
        $SQL = "DELETE FROM crypto_status WHERE account_id = :account_id AND crypto_code = :crypto_code";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['account_id' => $this->account_id, 'crypto_code' => $this->crypto_code]);
    }
}