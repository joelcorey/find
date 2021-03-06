<?php 

namespace Database;
use PDO;
class Database
{
    private $name;
    private $pdo;

    // public function __construct($name = "find")
    // {
    //     date_default_timezone_set('UTC');
    //     $this->name = $name;
    //     try 
    //     {
    //         $this->file_db = new PDO('sqlite:' . './data/' . $name . '.sqlite3');
    //         $this->file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         $this->createTableIpAddresses();
    //     } 
    //         catch (Exception $e) 
    //     {
    //         die('Query fail error: '. $e->getMessage());
    //     }        
    // }

    public function __construct($dbname = "find")
    {
        date_default_timezone_set('UTC');
        $this->name = $name;
        try 
        {
            $this->$pdo = new PDO("mysql:host=database;dbname=$dbname", "project", "project");
            $this->$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->$pdo->query("CREATE DATABASE IF NOT EXISTS $dbname");
            $this->createTableIpAddresses();
        } 
            catch (Exception $e) 
        {
            die('Query fail error: '. $e->getMessage());
        }        
    }

    public function selectSql($sql)
    {
        $statement = $this->$pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createTableIpAddresses()
    {
        $this->$pdo->exec(
            "CREATE TABLE IF NOT EXISTS ipAddresses 
            (
                id INTEGER PRIMARY KEY, 
                address TEXT(50), 
                port TEXT(50),
                httpCode text(50),
                totalTime text(50),
                nameLookupTime text(50),
                connectionTime text(50),
                pretransferTime text(50),
                speedDownload text(50),
                startupTransferTime text(50),
                rawData text(50),
                timeOfConnection text(50)
            )"
        );
    }

    public function insertIpAddress(
        $address, 
        $port, 
        $httpCode = NULL, 
        $totalTime = NULL, 
        $nameLookupTime = NULL, 
        $connectionTime = NULL, 
        $pretransferTime = NULL, 
        $speedDownload = NULL, 
        $startupTransferTime = NULL, 
        $rawData = NULL, 
        $timeOfConnection = NULL)
    {
        $insert = "INSERT INTO ipAddresses (
            address, 
            port, 
            httpCode, 
            totalTime, 
            nameLookupTime, 
            connectionTime, 
            pretransferTime, 
            speedDownload, 
            startupTransferTime, 
            rawData, 
            timeOfConnection) 
            VALUES (
            :address, 
            :port, 
            :httpCode, 
            :totalTime, 
            :nameLookupTime, 
            :connectionTime, 
            :pretransferTime, 
            :speedDownload, 
            :startupTransferTime, 
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
        $statement->bindParam(':startupTransferTime', $startupTransferTime);
        $statement->bindParam(':rawData', $rawData);
        $statement->bindParam(':timeOfConnection', $timeOfConnection);
        $statement->execute();
    }

}