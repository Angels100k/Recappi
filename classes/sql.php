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
      user.type AS `imgtype`, 
      user.email AS `email`, 
      user.bio AS `bio`,
      ufn_recipe_count(id) AS `recipes`, 
      ufn_follower_count(id) AS `followers`, 
      ufn_following_count(id) AS `following` 
      FROM user WHERE user.name = ? GROUP BY 1, 2, 3, 4, 5");
      $stmt->execute([$user]); 
      return $stmt;
    }

    public function getcookbookcat($cat, $user){
      $stmt = $this->conn->prepare("
      SELECT recipe, recipe.id, recipe.preptime, recipe.difficulty, recipe.waittime, recipe_image.image, recipe_image.type, ufn_likes_count(recipe.id) as likes, ufn_comment_count(recipe.id) as responses  FROM `recipe`
      	INNER JOIN category on category.name = ?
      	INNER JOIN user on user.name = ?
      	LEFT JOIN recipe_image ON (recipe_image.ReceptID = recipe.id AND recipe_image.order = 0)
      WHERE recipe.userid = user.id AND categoryid = category.id;");
 $stmt->execute([$cat, $user]); 
 return $stmt;
    }

    public function getshoplist($user){
      $stmt = $this->conn->prepare("
      SELECT grocery_list.item, grocery_list.amount 
      FROM user 
      RIGHT JOIN grocery_list ON grocery_list.userid = user.ID
      WHERE user.name = ?");
      $stmt->execute([$user]); 
      return $stmt;
    }
    public function getcookbookamount($user){
      $stmt = $this->conn->prepare("
      select category.name, ufn_cat_count(user.id, category.id) as amountrecipes
      from user
      RIGHT JOIN category ON 1
      WHERE user.name = ?
      ORDER BY 2 DESC");
      $stmt->execute([$user]); 
      return $stmt;
    }

    public function getprofileimg($id){
      $stmt = $this->conn->prepare("SELECT `image`, `imgtype` FROM `user` WHERE `id` = ?");
      $stmt->execute([$id]); 
      return $stmt;
    }
}