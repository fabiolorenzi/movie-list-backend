<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: POST");
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once "../../config/Database.php";
    include_once "../../models/Movie.php";

    $database = new Database();
    $db = $database->connect();

    $movie = new Movie($db);

    $data = json_decode(file_get_contents("php://input"));

    $movie->title = $data->title;
    $movie->genre = $data->genre;
    $movie->rel = $data->rel;
    $movie->descr = $data->descr;
    $movie->img = $data->img;

    if ($movie->create()) {
        echo json_encode(
            array("message" => "Movie added successfully")
        );
    } else {
        echo json_encode(
            array("message" => "Movie not inserted corrently")
        );
    };