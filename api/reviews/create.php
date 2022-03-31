<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: POST");
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once "../../config/Database.php";
    include_once "../../models/Review.php";

    $database = new Database();
    $db = $database->connect();

    $review = new Review($db);

    $data = json_decode(file_get_contents("php://input"));

    $review->title = $data->title;
    $review->text = $data->text;

    if ($review->create()) {
        echo json_encode(
            array("message" => "Review added successfully")
        );
    } else {
        echo json_encode(
            array("message" => "Review not inserted corrently")
        );
    };