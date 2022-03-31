<?php
    class Movie {
        private $conn;
        private $table = "movies";

        public $id;
        public $title;
        public $genre;
        public $rel;
        public $descr;
        public $img;
        public $created_at;


        // To connect to the db
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get all movies

        public function read() {
            $query = 'SELECT m.id, m.title, m.genre, m.rel, m.descr, m.img, m.created_at
                FROM ' . $this->table . ' m';

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }



        // Get a movie by id

        public function read_single() {
            $query = 'SELECT m.id, m.title, m.genre, m.rel, m.descr, m.img, m.created_at
                FROM ' . $this->table . ' m
                WHERE 
                    m.id = ?
                LIMIT 1';

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->title = $row["title"];
            $this->genre = $row["genre"];
            $this->rel = $row["rel"];
            $this->descr = $row["descr"];
            $this->img = $row["img"];
            $this->created_at = $row["created_at"];
        }




        // Insert a new movie

        public function create() {
            $query = 'INSERT INTO ' . $this->table . ' SET title = :title, genre = :genre, rel = :rel, descr = :descr, img = :img';

            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->genre = htmlspecialchars(strip_tags($this->genre));
            $this->rel = htmlspecialchars(strip_tags($this->rel));
            $this->descr = htmlspecialchars(strip_tags($this->descr));
            $this->img = htmlspecialchars(strip_tags($this->img));

            // Bind data
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":genre", $this->genre);
            $stmt->bindParam(":rel", $this->rel);
            $stmt->bindParam(":descr", $this->descr);
            $stmt->bindParam(":img", $this->img);

            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }