<?php

class Dbconfig {
    // personal sql server in XAMMP
    private $host;
    private $username ;
    private $password;
    private $dbname;
    public $conn;

    // __construct is used on startup when the class is being called
    public function __construct($host, $username, $password, $dbname) {
        $this->host = $host;
        $this->username  = $username;
        $this->password = $password;
        $this->dbname = $dbname;
      }

    // Public function to start the database connection
    public function getConnection() {
        // $ this for means that its ment for the public $conn in db.php (this file)
        $this->conn = null;

        // try so if fails we can see what goes wrong
        try{
            // this connection variable start a PDO connection with the sql server
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=".$this->dbname, $this->username, $this->password);
        // If there is an error it gets catched 
        }catch(PDOException $exception){
            // echo what is wrong with the connection
            return array("error" => 1, "errormessage" => $exception->getMessage());
        }
        return $this->conn;
    } 
} 
?>