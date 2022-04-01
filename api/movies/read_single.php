<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: GET");
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once "../../config/Database.php";
    include_once "../../models/Movie.php";

    $database = new Database();
    $db = $database->connect();

    $movie = new Movie($db);

    // Get ID
    $movie->id = isset($_GET["id"]) ? $_GET["id"] : die();
    $movie->read_single();

    $movie_arr = array(
        "id" => $movie->id,
        "title" => $movie->title,
        "genre" => $movie->genre,
        "rel" => $movie->rel,
        "descr" => $movie->descr,
        "img" => $movie->img,
        "created_at" => $movie->created_at
    );

    echo json_encode($movie_arr);