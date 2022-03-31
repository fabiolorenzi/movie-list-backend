<?php
    class Review {
        private $conn;
        private $table = "reviews";

        public $id;
        public $title;
        public $text;
        public $created_at;

        public function __construct($db) {
            $this->conn = $db;
        }


        // Get all the reviews

        public function read() {
            $query = 'SELECT r.id, r.title, r.text, m.created_at
                FROM ' . $this->table . ' r';

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }


        // Get a review by ID

        public function read_single() {
            $query = 'SELECT m.id, m.title, r.text, m.created_at
                FROM ' . $this->table . ' r
                WHERE 
                    r.id = ?
                LIMIT 1';

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->title = $row["title"];
            $this->text = $row["text"];
            $this->created_at = $row["created_at"];
        }


        // Create a new review

        public function create() {
            $query = 'INSERT INTO ' . $this->table . ' SET title = :title, text = :text';

            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->text = htmlspecialchars(strip_tags($this->text));

            // Bind data
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":text", $this->text);

            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        }


        // Delete a review

        public function delete() {
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bindParam(":id", $this->id);

            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }