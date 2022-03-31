<?php
    class Database  {
        private $host = "eu-cdbr-west-02.cleardb.net";
        private $username = "bac1d06d960ff7";
        private $password = "af0ed932";
        private $db_name = "heroku_1eb4b7e89ea7bd0";
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