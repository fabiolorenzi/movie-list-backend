<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include_once "../../config/Database.php";
    include_once "../../models/Review.php";

    $database = new Database();
    $db = $database->connect();

    $review = new Review($db);

    // Get ID
    $review->id = isset($_GET["id"]) ? $_GET["id"] : die();
    $review->read_single();

    $review_arr = array(
        "id" => $review->id,
        "title" => $review->title,
        "text" => $review->text,
        "created_at" => $review->created_at
    );

    echo json_encode($review_arr);