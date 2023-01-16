<?php
    class Database  {
        private $host = "127.0.0.1:3306";
        private $username = "user_movieList";
        private $password = "fl0R!bN9m";
        private $db_name = "movieList";
        private $conn;

        public function connect() {
            $this->conn = null;

            try { 
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }
        
            return $this->conn;
        }
    }