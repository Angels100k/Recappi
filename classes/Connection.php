<?php

// Deze file is alleen voor de connectie naar de database, niet voor database queries.

class Connection {
    private $servername = "localhost";
    private $database = "recappi";
    private $username = "root";
    private $password = "";
    private $conn;

    public function connectToDatabase() {
        if (!isset($conn)) {
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        }
        if ($this->conn->connect_error) {
            die("Connection failed: $this->conn->connect_error");
        }
        return $this->conn;
    }
}