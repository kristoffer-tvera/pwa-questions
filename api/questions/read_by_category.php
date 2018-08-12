<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../../php/db_connect.php';

    $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    $errorList = array();
    
    $category = $_GET["category"];
    if(IsNullOrEmptyString($category)){
        http_response_code(400);
        echo json_encode("category is a required parameter, named 'category'");
        return;
    }

    $category = htmlspecialchars(strip_tags($category));
    if(IsNullOrEmptyString($category)){
        http_response_code(400);
        echo json_encode("category needs to be a str");
        return;
    }

    $question = Get_question_by_category($category);

    if(is_null($question)){
        http_response_code(404);
        echo json_encode("Sorry, cant find anything there");
        return;
    }

    echo json_encode($question);

    function IsNullOrEmptyString($question){
        return (!isset($question) || trim($question)==='');
    }
?>