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
//       SELECT 	user.name AS "name",
// 		user.image AS "image",
// 		user.imgtype AS "imgtype",
// 		COUNT(recept.id) AS "recepts",
// 		COUNT(folowers.id) AS "followers",
// 		COUNT(folowing.id) AS "folowing"
// FROM user
// INNER JOIN recept ON recept.userid = user.ID
// INNER JOIN friends AS folowing ON folowing.user1 = user.ID
// INNER JOIN friends AS folowers ON folowers.user2 = user.ID
// WHERE user.name = "frank"
      $stmt = $this->conn->prepare("SELECT * FROM `user` WHERE `Name` = ?");
      $stmt->execute([$user]); 
      return $stmt;
    }

    public function getprofileimg($id){
      $stmt = $this->conn->prepare("SELECT `image`, `imgtype` FROM `user` WHERE `id` = ?");
      $stmt->execute([$id]); 
      return $stmt;
    }
}