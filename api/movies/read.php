<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: GET");
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    
    include_once "../../models/Movie.php";
    include_once "../../config/Database.php";

    $database = new Database();
    $db = $database->connect();

    $movie = new Movie($db);

    $result = $movie->read();
    $num = $result->rowCount();

    // Check if there are movies
    if ($num > 0) {
        $movies_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $singleMovie = array(
                "id" => $id,
                "title" => $title,
                "genre" => $genre,
                "rel" => $rel,
                "descr" => $descr,
                "img" => $img,
                "created_at" => $created_at
            );

            array_push($movies_arr, $singleMovie);
        };
        // Convert to JSON and output
        echo json_encode($movies_arr);
    } else {
        echo json_encode(
            array("message" => "No movies found")
        );
    };