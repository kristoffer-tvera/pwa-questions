<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once $_SERVER['DOCUMENT_ROOT'].'/php/db_connect.php';

    $data = json_decode(file_get_contents("php://input"));
    $errorList = array();

    $id = $data->id;
    $id = htmlspecialchars(strip_tags($id));
    if(IsNullOrEmptyString($id)){
        array_push($errorList, "Id is a required field ('category'), int");
    }

    if(!is_numeric($id)){
        array_push($errorList, "Id must be a number int");
    }

    $id = intval($id); //cast to int to make sure we dont goofd
    
    $first = filter_var($data->first, FILTER_VALIDATE_BOOLEAN);

    if(empty($data->first)){
        array_push($errorList, "First choice is a required field ('first'), bool");
    }
    
    if(!empty($errorList)){
        http_response_code(400);
        echo json_encode($errorList);
        return;
    } else {
        if(Question_vote($id, $first)){
            echo json_encode("Question successfully updated");  
        } else {
            http_response_code(400);
            echo json_encode("Failed updating question");
        }
        
    }

    function IsNullOrEmptyString($question){
        return (!isset($question) || trim($question)==='');
    }

?>