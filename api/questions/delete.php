<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../php/db_connect.php';

    $data = json_decode(file_get_contents("php://input"));
    $errorList = array();

    $id = $data->id;

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

    if(!empty($errorList)){
        http_response_code(404);
        echo json_encode($errorList);
        return;
    } else {
        Delete_question($id);
        echo json_encode("Question successfully deleted");
    }

    function IsNullOrEmptyString($question){
        return (!isset($question) || trim($question)==='');
    }

?>