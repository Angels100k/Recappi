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
      user.id AS `id`, 
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
    public function emailverify($mail){
      $stmt = $this->conn->prepare("
      SELECT * FROM user WHERE `email`= ?");
      $stmt->execute([$mail]); 
      return $stmt;
    }

    public function updatelike($postid){
      $userid = $_SESSION["id"];
      $stmt = $this->conn->prepare("
        CALL likePost(?,?,@id, @count);
        SELECT @id,@count;");
      $stmt->execute([$postid, $userid]); 
      return $stmt;
    }
    public function updategrocery($postid){
      $userid = $_SESSION["id"];
      $stmt = $this->conn->prepare("
        CALL updategrocery(?,?,@id);
        SELECT @id;");
      $stmt->execute([$postid, $userid]); 
      return $stmt;
    }

    public function updatesave($postid){
      $userid = $_SESSION["id"];
      $stmt = $this->conn->prepare("
        CALL savePost(?,?,@id);
        SELECT @id;");
      $stmt->execute([$postid, $userid]); 
      return $stmt;
    }

    public function ingredientlist(){
      $stmt = $this->conn->prepare("
      SELECT grocery_list.amount, grocery_list.id as id, grocery_list.owned, amount.amount as amountunit, amount.unit, ingredient.ingredient FROM `grocery_list`
INNER JOIN amount on amount.id = grocery_list.amountid
INNER JOIN ingredient on ingredient.id = amount.ingredientid
WHERE grocery_list.userid = ?");
 $stmt->execute([$_SESSION["id"]]);
 return $stmt;
    }

    public function getcookbookcat($cat, $user){
      $stmt = $this->conn->prepare("
      SELECT recipe.recipe, recipe.id, recipe.preptime, recipe.difficulty, recipe.waittime, recipe.totaltime, user.id AS userid, recipe_image.image,
      recipe_image.type AS type, liked.id AS likeid, saved_recipe.id AS saveid, ufn_likes_count(recipe.id) AS likes,
      ufn_reactions_count(recipe.id) AS repsonses FROM `recipe`
      INNER JOIN category on category.name = ?
      INNER JOIN user on user.name = ?
      LEFT JOIN recipe_image ON (recipe_image.recipeid = recipe.id AND recipe_image.order = 0)
      LEFT JOIN `liked` ON (liked.receptid = recipe.id AND liked.userid = ?)
      LEFT JOIN `saved_recipe` ON (saved_recipe.receptid = recipe.id AND saved_recipe.userid = ?)
      WHERE recipe.userid = user.id AND categoryid = category.id AND recipe.draft = 0");
 $stmt->execute([$cat, $user, $_SESSION["id"], $_SESSION["id"]]); 
 return $stmt;
    }
    public function getcookbookdiscover(){
      $stmt = $this->conn->prepare("
      SELECT discovery.order, recipe.recipe, recipe.id, recipe.preptime, recipe.difficulty, recipe.waittime, recipe.totaltime, user.id AS userid, recipe_image.image,
      recipe_image.type AS type, liked.id AS likeid, saved_recipe.id AS saveid, ufn_likes_count(recipe.id) AS likes,
      ufn_reactions_count(recipe.id) AS repsonses 
      FROM `discovery`
      LEFT JOIN recipe ON (recipe.id = discovery.receptid)
      INNER JOIN user on user.id = recipe.userid
      LEFT JOIN recipe_image ON (recipe_image.recipeid = recipe.id AND recipe_image.order = 0)
      LEFT JOIN `liked` ON (liked.receptid = recipe.id AND liked.userid = ?)
      LEFT JOIN `saved_recipe` ON (saved_recipe.receptid = recipe.id AND saved_recipe.userid = ?)
      WHERE recipe.draft = 0 ORDER BY discovery.order ASC");
 $stmt->execute([$_SESSION["id"], $_SESSION["id"]]); 
 return $stmt;
    }

    public function getcookbookdraftbig(){
      $stmt = $this->conn->prepare("
      SELECT recipe.id, recipe.recipe, recipe_image.image AS image, recipe_image.type AS type
      FROM `recipe`
      INNER JOIN user on user.id = ?
      LEFT JOIN recipe_image ON (recipe_image.recipeid = recipe.id AND recipe_image.order = 0)
      WHERE recipe.userid = user.id AND recipe.draft = 1");
 $stmt->execute([$_SESSION["id"]]); 
 return $stmt;
    }

    public function getshoplist(){
      $stmt = $this->conn->prepare("
      SELECT amountid, amount, owned, creation_date 
      FROM grocery_list 
      WHERE userid = ?");
      $stmt->execute([$_SESSION["id"]]); 
      return $stmt;
    }
    public function getcookbookamount($user){
      $stmt = $this->conn->prepare("
      select category.name, ufn_cat_count(user.id, category.id) as amountrecepts
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