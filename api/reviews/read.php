<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    
    include_once "../../models/Review.php";
    include_once "../../config/Database.php";

    $database = new Database();
    $db = $database->connect();

    $review = new Review($db);

    $result = $review->read();
    $num = $result->rowCount();

    // Check if there are movies
    if ($num > 0) {
        $review_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $singleReview = array(
                "id" => $id,
                "title" => $title,
                "text" => $text,
                "created_at" => $created_at
            );

            array_push($review_arr, $singleReview);
        };
        // Convert to JSON and output
        echo json_encode($review_arr);
    } else {
        echo json_encode(
            array("message" => "No reviews found")
        );
    };