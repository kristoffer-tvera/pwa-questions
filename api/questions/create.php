<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once $_SERVER['DOCUMENT_ROOT'].'/php/db_connect.php';

    $data = json_decode(file_get_contents("php://input"));
    $errorList = array();

    $category = $data->category;
    $category = htmlspecialchars(strip_tags($category));
    if(IsNullOrEmptyString($category)){
        array_push($errorList, "Category is a required field ('category'), str");
    }
    
    $first = $data->first;
    $first = htmlspecialchars(strip_tags($first));
    if(IsNullOrEmptyString($first)){
        array_push($errorList, "First choice is a required field ('first'), str");
    }

    $second = $data->second;
    $second = htmlspecialchars(strip_tags($second));
    if(IsNullOrEmptyString($second)){
        array_push($errorList, "Second choice is a required field ('second'), str");
    }

    if(!empty($errorList)){
        http_response_code(400);
        echo json_encode($errorList);
        return;
    } else {
        Add_question($first, $second, $category);
        echo json_encode("Question successfully added");
    }

    function IsNullOrEmptyString($question){
        return (!isset($question) || trim($question)==='');
    }
?>