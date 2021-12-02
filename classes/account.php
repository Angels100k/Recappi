<?php

class account extends Connection{
    private $ID;
    private $name;
    private $email;
    private $email2;
    private $image;
    private $imagetype;
    private $bio;
    private $password;
    private $password2;
    private $conn;

    public function  __construct(){
        $this->conn = $this->connectToDatabase();
    }
    public function login($email, $password){
        $this->email = $email;
        $this->password = $password;

        $query = "SELECT * FROM `user` WHERE `email`= ?";

        if($stmt = $this->conn->prepare($query)){
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            if($stmt->num_rows > 0){
                $stmt->bind_result($ID, $name, $image, $imagetype, $bio, $email2, $password2);
                $stmt->fetch();

                if(password_verify($this->password, $password2)){
                    $_SESSION["uid"] = $ID;
                    $_SESSION["name"] = $name;
                    $_SESSION["login"] = true;

                    return true;
                } else{
                    return false;
                }
            } else{
                return false;
            }
        } else{
            return false;
        }
    }
    public function register($name, $email, $password, $password2){
        if($password != $password2){
            return "Passwords are not the same";
        }
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->password2 = $password2;

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        $query = "INSERT INTO `user` (name, email, password) VALUES ('$this->name', '$this->email', '$this->password')";
        if($this->conn->query($query)){
            return $this->login($this->email, $this->password);
        }
        return false;
    }

}