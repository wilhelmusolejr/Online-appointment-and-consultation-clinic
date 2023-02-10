<?php

class Database{
    private $host = 'localhost';
    private $database = 'u117888000_clinic';
    private $username = 'u117888000_clinic';
    private $password = 'Qw09058222';
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