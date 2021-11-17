<?php 
class Sql {
  // set varriable connnection so it can get accesst only in this file in every function
    private $conn;

    // __construct is used on startup when the class is being called
    public function __construct($db) {
      // the variable $db is the data from db.php saved in the conn variable for global use
        $this->conn = $db;
    }

    public function getprofile($user){
      $stmt = $this->conn->prepare("SELECT `email`, `image`, `imgtype` FROM `user` WHERE `Name` = ?");
      $stmt->execute([$user]); 
      return $stmt;
    }
}