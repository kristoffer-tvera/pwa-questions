<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../../php/db_connect.php';

    $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    $errorList = array();
    
    $id = $_GET["id"];
    if(IsNullOrEmptyString($id)){
        http_response_code(400);
        echo json_encode("Id is a required parameter, named 'id'");
        return;
    }

    $id = htmlspecialchars(strip_tags($id));
    if(IsNullOrEmptyString($id)){
        http_response_code(400);
        echo json_encode("Id needs to be a number");
        return;
    }

    if(!is_numeric($id)){
        http_response_code(400);
        echo json_encode("Id needs to be a number");
        return;
    } else {
        $id = intval($id); //cast to int to make sure we dont goofd
    }

    $question = Get_question_by_id($id);

    if(is_null($question)){
        http_response_code(404);
        echo json_encode("Sorry, cant find that one");
        return;
    }

    echo json_encode($question);


    function IsNullOrEmptyString($question){
        return (!isset($question) || trim($question)==='');
    }
?>