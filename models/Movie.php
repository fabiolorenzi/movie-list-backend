<?php
    class Movie {
        private $conn;
        private $table = "movies";

        public $id;
        public $title;
        public $genre;
        public $year;
        public $desc;
        public $img;
        public $created_at;


        // To connect to the db
        public function _construct($db) {
            $this->conn = $db;
        }

        // Get all movies

        public function read() {
            $query = "SELECT m.id, m.title, m.genre, m.year, m.desc, m.img, m.created_at
                FROM " . $this->table . " m";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }
    }