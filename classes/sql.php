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
      $stmt = $this->conn->prepare("
      SELECT 
      user.name AS `name`, 
      user.image AS `image`, 
      user.imgtype AS `imgtype`, 
      user.email AS `email`, 
      user.bio AS `bio`,
      ufn_recept_count(id) AS `recepts`, 
      ufn_follower_count(id) AS `followers`, 
      ufn_following_count(id) AS `following` 
      FROM user WHERE user.name = ? GROUP BY 1, 2, 3, 4, 5");
      $stmt->execute([$user]); 
      return $stmt;
    }

    public function getcookbookcat($cat, $user){
      $stmt = $this->conn->prepare("
      SELECT receptname FROM `recept`
INNER JOIN categorie on categorie.catoriename = ?
INNER JOIN user on user.name = ?
 WHERE recept.userid = user.id AND categorieid = categorie.id;");
 $stmt->execute([$cat, $user]); 
 return $stmt;
    }

    public function getshoplist($user){
      $stmt = $this->conn->prepare("
      SELECT boodschappenlijst.item, boodschappenlijst.hoeveelheidid 
      FROM user 
      RIGHT JOIN boodschappenlijst ON boodschappenlijst.userid = user.ID
      WHERE user.name = ?");
      $stmt->execute([$user]); 
      return $stmt;
    }
    public function getcookbookamount($user){
      $stmt = $this->conn->prepare("
      SELECT boodschappenlijst.item, boodschappenlijst.hoeveelheidid 
      FROM user 
      RIGHT JOIN boodschappenlijst ON boodschappenlijst.userid = user.ID
      WHERE user.name = ?");
      $stmt->execute([$user]); 
      return $stmt;
    }

    public function getprofileimg($id){
      $stmt = $this->conn->prepare("SELECT `image`, `imgtype` FROM `user` WHERE `id` = ?");
      $stmt->execute([$id]); 
      return $stmt;
    }
}