<?php 

class database
{
    private $name;
    public $file_db;

    public function __construct($name = "findit")
    {
        date_default_timezone_set('UTC');
        $this->name = $name;
        try 
        {
            $this->file_db = new PDO('sqlite:' . $name . '.sqlite3');
            $this->file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->createTableIp();
        } 
            catch (Exception $e) 
        {
            die('Query fail error: '. $e->getMessage());
        }        
    }

    public function createTableIp()
    {
        $this->file_db->exec
        (
            "CREATE TABLE IF NOT EXISTS ip 
            (
                id INTEGER PRIMARY KEY, 
                address TEXT, 
                port TEXT, 
                time INTEGER
            )"
        );
    }

    public function insertIp($address, $port)
    {
        $insert = "INSERT INTO ip (address, port) VALUES (:address, :port)";
        $statement = $this->file_db->prepare($insert);
        $statement->bindParam(':address', $address);
        $statement->bindParam(':port', $port);
        $statement->execute();
    }

    

}