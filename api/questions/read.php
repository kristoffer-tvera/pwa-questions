<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once $_SERVER['DOCUMENT_ROOT'].'/php/db_connect.php';

    $question = Get_question_random();

    if(is_null($question)){
        http_response_code(404);
        echo json_encode("Looks like we dont have questions lol");
        return;
    }

    echo json_encode($question);
?>