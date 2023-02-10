<?php

class Database{
    private $host = 'localhost';
    private $username = 'u117888000_clinic';
    private $password = 'Qw09058222';
    private $database = 'u117888000_clinic';
    protected $connection;

    function connect(){
        try 
			{
				$this->connection = new PDO("mysql:host=$this->host;dbname=$this->database", 
											$this->username, $this->password);
			} 
			catch (PDOException $e) 
			{
				echo "Connection error " . $e->getMessage();
			}
        return $this->connection;
    }
}
