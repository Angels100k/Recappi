<?php 

class procedures {
    private $conn;

    // __construct is used on startup when the class is being called
  public function __construct($db) {
      // the variable $db is the data from db.php saved in the conn variable for global use
        $this->conn = $db;
  }

  public function addIngredient($json){
    // [$json["ingredientDesc"], $_SESSION["id"], $json["recipeId"], $json["ingredientAmount"], $json["ingredientUntit"], $json["id"]]
    $CURRENTID = null;
    $OUT_result;
    $stmt = $this->conn->prepare("SELECT id  FROM ingredient WHERE ingredient = ? AND userid = ? LIMIT 1;");
    $stmt->execute([$json["ingredientDesc"], $_SESSION["id"]]); 

    while ($row = $stmt->fetch()) {
        $CURRENTID = $row["id"];
    }
    
    if($CURRENTID == null){
        $OUT_result = 1; 
    }else{
        $OUT_result = 0; 
    }

    if($OUT_result == 1){
        $stmt = $this->conn->prepare("INSERT INTO `ingredient`(`userid`, `ingredient`) VALUES (?, ?);");
        $stmt->execute([$_SESSION["id"], $json["ingredientDesc"]]); 

        $stmt = $this->conn->prepare("SELECT max(id) as id FROM `ingredient` WHERE 1;");
        $stmt->execute(); 

        while ($row = $stmt->fetch()) {
            $CURRENTID = $row["id"];
        }
    }

    if($json["id"] == 0){
        $stmt = $this->conn->prepare("INSERT INTO `amount`(`recipeid`, `ingredientid`, `amount`, `unit`) VALUES (?,?,?,?);");
        $stmt->execute([$json["recipeId"], $CURRENTID, $json["ingredientAmount"], $json["ingredientUntit"]]); 
    }else {
        $stmt = $this->conn->prepare("UPDATE `amount` SET `ingredientid` =  ?,`amount`= ?,`unit`= ? WHERE id = ?;");
        $stmt->execute([$CURRENTID, $json["ingredientAmount"], $json["ingredientUntit"], $json["id"]]); 
    }

    $stmt = $this->conn->prepare("SELECT id FROM ingredient WHERE ingredient = ? AND userid = ? LIMIT 1;");
    $stmt->execute([$json["ingredientDesc"], $_SESSION["id"]]); 

    return $stmt;
  }

  public function likePost($postid){
    // $userid = $_SESSION["id"];
    // $stmt = $this->conn->prepare("
    //   CALL likePost(?,?,@id, @count);
    //   SELECT @id,@count;");
    // $stmt->execute([$postid, $userid]);
    $CURRENTID = null;
    $OUT_result;

    $stmt = $this->conn->prepare("SELECT id FROM liked WHERE receptid = ? AND userid = ? LIMIT 1;");
    $stmt->execute([$postid, $_SESSION["id"]]); 

    while ($row = $stmt->fetch()) {
        $CURRENTID = $row["id"];
    }
    
    if($CURRENTID == null){
        $OUT_result = 1; 

    }else {
        $OUT_result = 0;
    }

    if($OUT_result == 1){
        $stmt = $this->conn->prepare("INSERT INTO `liked`(`receptid`, `userid`) VALUES (?, ?);");
        $stmt->execute([$postid, $_SESSION["id"]]); 
    }else {
        $stmt = $this->conn->prepare("DELETE FROM `liked` WHERE `receptid` = ? AND `userid` = ?;");
        $stmt->execute([$postid, $_SESSION["id"]]);
    }
    $stmt = $this->conn->prepare("SELECT ? as OUT_result, (select COUNT(*) from liked	where receptid = ?) AS likes;");
    $stmt->execute([$OUT_result, $postid]);

    return $stmt;
  }

  public function savePost($postid, $catid){
    $CURRENTID = null;

    $stmt = $this->conn->prepare("SELECT id FROM saved_recipe WHERE receptid = ? AND userid = ? LIMIT 1;");
    $stmt->execute([$postid, $_SESSION["id"]]); 
    
    while ($row = $stmt->fetch()) {
        $CURRENTID = $row["id"];
    }
    
    if($CURRENTID == NULL){
        $OUT_result = 1; 
    }else {
        $OUT_result = 0;
    }

    if($OUT_result == 1){
        $stmt = $this->conn->prepare("INSERT INTO `saved_recipe`(`receptid`, `userid`, `categoryid`) VALUES (?, ?, ?);");
        $stmt->execute([$postid, $_SESSION["id"], $catid]); 
    }else {
        $stmt = $this->conn->prepare("DELETE FROM `saved_recipe` WHERE `receptid` = ? AND `userid` = ?;");
        $stmt->execute([$postid, $_SESSION["id"]]); 
    }
    $stmt = $this->conn->prepare("SELECT ? as OUT_result");
    $stmt->execute([$OUT_result]); 
    return $stmt;
  }

  public function updatefollowing($followid){
    $CURRENTID = null;
    $OUT_result;
    $stmt = $this->conn->prepare("SELECT id FROM follower WHERE user1 = ? AND user2 = ? LIMIT 1;");
    $stmt->execute([$_SESSION["id"], $followid]); 
    
    while ($row = $stmt->fetch()) {
        $CURRENTID = $row["id"];
    }
    
    if($CURRENTID == null){
        $OUT_result = 1; 
    }else {
        $OUT_result = 0;
    }

    if($OUT_result == 1){
        $stmt = $this->conn->prepare("INSERT INTO `follower`(`user1`, `user2`) VALUES (?, ?);");
        $stmt->execute([$_SESSION["id"], $followid]); 
    }else {
        $stmt = $this->conn->prepare("DELETE FROM `follower` WHERE `user1` = ? AND `user2` = ?;");
        $stmt->execute([$_SESSION["id"], $followid]); 
    }
    $stmt = $this->conn->prepare("SELECT ? as OUT_result");
    $stmt->execute([$OUT_result]); 
    return $stmt;
  }

  public function updategrocery($postid){
    $CURRENTID = null;
    $OUT_result;
    $stmt = $this->conn->prepare("SELECT id FROM grocery_list WHERE id = ? AND userid = ? AND owned = 1 LIMIT 1;");
    $stmt->execute([$postid, $_SESSION["id"]]); 
    
    while ($row = $stmt->fetch()) {
        $CURRENTID = $row["id"];
    }
    
    if($CURRENTID == null){
        $OUT_result = 1; 
    }else {
        $OUT_result = 0;
    }

    $stmt = $this->conn->prepare("UPDATE `grocery_list` SET `owned` = ? WHERE `grocery_list`.`id` = ? AND userid = ?");
    $stmt->execute([$OUT_result,$postid, $_SESSION["id"]]); 
    
    $stmt = $this->conn->prepare("SELECT ? as OUT_result");
    $stmt->execute([$OUT_result]); 
    return $stmt;
  }

  
  public function registeruser($name, $username, $email, $password){
    $CURRENTID = null;
    $OUT_result;
    $stmt = $this->conn->prepare("SELECT id FROM user WHERE name = ? OR email = ? LIMIT 1;");
    $stmt->execute([$name, $email]); 
    
    while ($row = $stmt->fetch()) {
        $CURRENTID = $row["id"];
    }

    if($CURRENTID == null){
        $OUT_result = 1; 
    }else {
        $OUT_result = 0;
    }
    
    if($OUT_result == 1){
        $stmt = $this->conn->prepare("INSERT INTO `user`(`email`, `name`, `username`, `password`) VALUES (?, ?, ?, ?)");
        $stmt->execute([$email,$name, $username, $password]); 

        $stmt = $this->conn->prepare("SELECT id  FROM `user` WHERE name = ?;");
        $stmt->execute([$name]); 
        
        while ($row = $stmt->fetch()) {
            $OUT_result = $row["id"];
        }
    }
    $stmt = $this->conn->prepare("SELECT ? as OUT_result");
    $stmt->execute([$OUT_result]); 
    return $stmt;
  }

  public function addShoppingList($PIngredientId, $PPortion, $PListId, $Punit, $PunitAmount){
	$CURRENTID = null;
	$CURRENTIDAMOUNT = null;
    
    $stmt = $this->conn->prepare("SELECT id FROM `amount` WHERE `amount`.`amount` = ? AND `amount`.`unit` = ? AND `amount`.`ingredientid` = ?;");
    $stmt->execute([$PunitAmount, $Punit, $PIngredientId]); 
    
    while ($row = $stmt->fetch()) {
        $CURRENTIDAMOUNT = $row["id"];
    }
    
    if($CURRENTIDAMOUNT == null){
        $stmt = $this->conn->prepare("INSERT INTO `amount`(`ingredientid`, `amount`, `unit`) VALUES (?, ?, ?);");
        $stmt->execute([$PIngredientId, $PunitAmount, $Punit]); 
        
        $stmt = $this->conn->prepare("SELECT id  FROM `amount` WHERE `amount`.`amount` = ? AND `amount`.`unit` = ? AND `amount`.`ingredientid` = ?;");
        $stmt->execute([$PunitAmount, $Punit, $PIngredientId]); 
        
        while ($row = $stmt->fetch()) {
            $CURRENTIDAMOUNT = $row["id"];
        } 
    }
    
    $stmt = $this->conn->prepare("SELECT id FROM grocery_list WHERE amountid = ? AND userid = ? LIMIT 1;");
    $stmt->execute([$CURRENTIDAMOUNT, $_SESSION["id"]]); 
    
    while ($row = $stmt->fetch()) {
        $CURRENTID = $row["id"];
    }
    
	if($CURRENTID == null){
        $stmt = $this->conn->prepare("INSERT INTO `grocery_list`(`userid`, `amountid`, `amount`) VALUES (?, ?, ?);");
        $stmt->execute([$_SESSION["id"], $CURRENTIDAMOUNT, $PPortion]); 
		
    }else {
        if($pListId == 0){
            $stmt = $this->conn->prepare("UPDATE `grocery_list` SET `amount`= (? + amount) WHERE id = ?;");
            $stmt->execute([$PPortion, $CURRENTID]);
        }else {
            $stmt = $this->conn->prepare("UPDATE `grocery_list` SET `amount`= ? WHERE id = ?;");
            $stmt->execute([$PPortion, $CURRENTID]);
        }
    }
  }


  public function addNewShoppingList($json){
	$CURRENTAMOUNDID = null;

    $stmt = $this->addIngredient($json);
    while ($row = $stmt->fetch()) {
        $CURRENTAMOUNDID = $row["id"];
    }
    $stmt = $this->addShoppingList($CURRENTAMOUNDID, $json["ingredientAmount"], $json["id"], $json["ingredientUntit"], $json["ingredientVolume"]);
    return 0;
  }
}