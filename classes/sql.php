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
      user.username AS `username`, 
      user.name AS `name`, 
      user.image AS `image`, 
      user.imgtype AS `imgtype`, 
      user.email AS `email`, 
      user.bio AS `bio`,
      ufn_recept_count(id) AS `recepts`, 
      ufn_follower_count(id) AS `followers`, 
      ufn_following_count(id) AS `following`,
      (SELECT COUNT(*) FROM follower WHERE user2 = ? AND user1 = user.ID ) as personfollow
      FROM user WHERE user.name = ? GROUP BY 1, 2, 3, 4, 5");
      $stmt->execute([$_SESSION["id"], $user]); 
      return $stmt;
    }
    public function getprofileedit(){
      $stmt = $this->conn->prepare("
      SELECT 
      user.id AS `id`, 
      user.username AS `username`, 
      user.image AS `image`, 
      user.imgtype AS `imgtype`, 
      user.email AS `email`, 
      user.bio AS `bio`
      FROM user WHERE user.id = ?");
      $stmt->execute([$_SESSION["id"]]); 
      return $stmt;
    }
    public function emailverify($mail){
      $stmt = $this->conn->prepare("
      SELECT * FROM user WHERE `email`= ?");
      $stmt->execute([$mail]); 
      return $stmt;
    }

    public function updatesaveprofile($json){
      $stmt = $this->conn->prepare("
      UPDATE `user` SET `image`= ?,`imgtype`=?,`email`=?,`username`=?,`bio`=? WHERE id = ?");
      $stmt->execute([$json[0], $json[1],$json[3],$json[2],$json[4], $_SESSION["id"]]); 
      return $stmt;
    }

    public function getfriends(){
      $stmt = $this->conn->prepare("
      SELECT user.name AS `name`, user.username AS `username`, user.image AS `image`, user.imgtype AS `imgtype`, ufn_recept_count(user.id) AS `recepts`  FROM `follower` 
INNER JOIN user on user.id = user2
WHERE user1 = ?");
      $stmt->execute([$_SESSION["id"]]); 
      return $stmt; 
    }
    public function updatefollow($followid){
        $userid = $_SESSION["id"];
        $stmt = $this->conn->prepare("
        CALL updatefollowing(?,?,@id);
        SELECT @id;");
        $stmt->execute([$followid, $userid]);
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

    public function registerUser($name, $username, $email, $hashedPassword){
      $stmt = $this->conn->prepare("
      CALL registeruser(?,?,?,?,@out);
      SELECT @out;");
    $stmt->execute([$name, $username, $email, $hashedPassword]); 
    return $stmt;
    }

    public function loginUser($email){
      $stmt = $this->conn->prepare("
      SELECT id, password FROM user where email = ?;");
    $stmt->execute([$email]); 
    return $stmt;
    }

    public function getcookbookcat($cat, $user){
      $stmt = $this->conn->prepare("
      SELECT recipe.recipe, recipe.id, recipe.preptime, recipe.difficulty, recipe.waittime, recipe.cooktime, user.id AS userid, recipe_image.image,
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
      SELECT discovery.order, recipe.recipe, recipe.id, recipe.preptime, recipe.difficulty, recipe.waittime, recipe.cooktime, user.id AS userid, recipe_image.image,
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

    public function getcookbookresentbig(){
      $stmt = $this->conn->prepare("
      SELECT recipe.id, recipe.recipe, recipe_image.image AS image, recipe_image.type AS type, saved_recipe.creation_date 
      FROM `saved_recipe`
      LEFT JOIN recipe on recipe.id = saved_recipe.receptid 
      LEFT JOIN recipe_image ON (recipe_image.recipeid = recipe.id AND recipe_image.order = 0) 
      WHERE saved_recipe.userid = ? 
      AND recipe.draft = 0 
      AND saved_recipe.creation_date >= DATE_SUB(CURDATE(), INTERVAL DAYOFMONTH(CURDATE())-1 DAY) 
      ORDER BY saved_recipe.creation_date DESC");
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
    public function getcookbookamountprofile($user){
      $stmt = $this->conn->prepare("
      select user.name as username, category.name, ufn_cat_count(user.id, category.id) as amountrecepts
      from user
      RIGHT JOIN category ON 1
      WHERE user.id = ?
      ORDER BY 2 DESC");
      $stmt->execute([$user]); 
      return $stmt;
    }

    public function getprofileimg($id){
      $stmt = $this->conn->prepare("SELECT `image`, `name`, `imgtype` FROM `user` WHERE `id` = ?");
      $stmt->execute([$id]); 
      return $stmt;
    }

    public function getrecipedefault($id){
      $stmt = $this->conn->prepare("
      SELECT recipe.recipe AS recipe, recipe.preptime, recipe.waittime, recipe.cooktime, recipe.description,
      ufn_likes_count(recipe.id) AS likes, ufn_reactions_count(recipe.id) AS repsonses,
      (SELECT COUNT(*) FROM saved_recipe WHERE  saved_recipe.receptid = recipe.id AND saved_recipe.userid = ?) AS saved,
      (SELECT COUNT(*) FROM liked WHERE  liked.receptid = recipe.id AND liked.userid = ?) AS liked,
      user.name, user.image, user.imgtype
      FROM recipe
      INNER JOIN user ON user.ID = recipe.userid
      WHERE recipe.id = ?");
      $stmt->execute([$_SESSION["id"],$_SESSION["id"], $id]); 
      return $stmt;
    }

    public function receppiimages($id){
      $stmt = $this->conn->prepare("
      SELECT image, type, `order` FROM `recipe_image` WHERE recipeid = ?");
      $stmt->execute([$id]); 
      return $stmt;
    }
    public function receppicomments($id){
      $stmt = $this->conn->prepare("
      SELECT  comment.comment , user.image, user.imgtype, user.username, user.name
      FROM `comment` 
      INNER JOIN user ON user.ID = comment.userid
      WHERE recipeid = ?");
      $stmt->execute([$id]); 
      return $stmt;
    }
}