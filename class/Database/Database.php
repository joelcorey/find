<?php 

namespace Database;
use PDO;
class Database
{
    private $name;
    public $file_db;

    public function __construct($name = "find")
    {
        date_default_timezone_set('UTC');
        $this->name = $name;
        try 
        {
            $this->file_db = new PDO('sqlite:' . './data/' . $name . '.sqlite3');
            $this->file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->createTableIpAddresses();
        } 
            catch (Exception $e) 
        {
            die('Query fail error: '. $e->getMessage());
        }        
    }

    public function createTableIpAddresses()
    {

        $this->file_db->exec(
            "CREATE TABLE IF NOT EXISTS ipAddresses 
            (
                id INTEGER PRIMARY KEY, 
                address TEXT, 
                port TEXT,
                httpCode text,
                totalTime text,
                nameLookupTime text,
                connectionTime text,
                pretransferTime text,
                speedDownload text,
                startupTransfertime text,
                rawData text,
                timeOfConnection INTEGER
            )"
        );
    }

    public function insertIp(
        $address, 
        $port, 
        $httpCode = NULL, 
        $totalTime = NULL, 
        $nameLookupTime = NULL, 
        $connectionTime = NULL, 
        $pretransferTime = NULL, 
        $speedDownload = NULL, 
        $startupTransfertime = NULL, 
        $rawData = NULL, 
        $timeOfConnection = NULL)
    {
        $insert = "INSERT INTO ip (
            address, 
            port, 
            $httpCode, 
            $totalTime, 
            $nameLookupTime, 
            $connectionTime, 
            $pretransferTime, 
            $speedDownload, 
            $startupTransfertime, 
            $rawData, 
            $timeOfConnection) 
            VALUES (
            :address, 
            :port, 
            :httpCode, 
            :totalTime, 
            :nameLookupTime, 
            :connectionTime, 
            :pretransferTime, 
            :speedDownload, 
            :startupTransfertime, 
            :rawData, 
            :timeOfConnection)";
        $statement = $this->file_db->prepare($insert);
        $statement->bindParam(':address', $address);
        $statement->bindParam(':port', $port);
        $statement->bindParam(':httpCode', $httpCode);
        $statement->bindParam(':totalTime', $totalTime);
        $statement->bindParam(':nameLookupTime', $nameLookupTime);
        $statement->bindParam(':connectionTime', $connectionTime);
        $statement->bindParam(':pretransferTime', $pretransferTime);
        $statement->bindParam(':speedDownload', $speedDownload);
        $statement->bindParam(':startupTransfertime', $startupTransfertime);
        $statement->bindParam(':rawData', $rawData);
        $statement->bindParam(':timeOfConnection', $timeOfConnection);
        $statement->execute();
    }

}