<?php

function Dump_table(){
    require 'db_config.php';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    $sql = "SELECT * FROM $dbtable_questions";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<br>id: " . $row["id"];
            echo "<br>Alternative one: " . $row["first_alternative"] .  ", Score: " . $row["first_alternative_count"];
            echo "<br>Alternative two: " . $row["second_alternative"] .  ", Score: " . $row["second_alternative_count"];
        }
    } else {
        echo "0 results";
    }
    $conn->close();
}

function Add_question($alt1, $alt2, $category){
    require 'db_config.php';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    $sql = "INSERT INTO $dbtable_questions (category, first_alternative, second_alternative, created_at) VALUES ('" . strtolower( strval( $category ) ). "', '". strval( $alt1 ) . "', '". strval( $alt2 ) . "', now())";
    
    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully";
        return true;
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
    $conn->close();
}

function Question_vote($questionId, $first){
    require 'db_config.php';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    if(boolval($first)){
        $sql = "UPDATE $dbtable_questions SET first_alternative_count = first_alternative_count + 1 WHERE id = '". intval($questionId) ."'";
    } else {
        $sql = "UPDATE $dbtable_questions SET second_alternative_count = second_alternative_count + 1 WHERE id = '". intval($questionId) ."'";
    }
    
    if ($conn->query($sql) === TRUE) {
        //echo "Successfully updated";
        return true;
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
    $conn->close();
}

function Get_question_by_id($id){ 
    require 'db_config.php';  
    $sql = "SELECT * FROM `$dbtable_questions` WHERE id = '" . intval($id) . "'";
    return Get_single_question($sql);
}
function Get_question_by_category($category){
    require 'db_config.php'; 
    $sql = "SELECT * FROM `$dbtable_questions` WHERE category = '". strtolower( strval( $category ) ) ."' AND  id >= (SELECT FLOOR( MAX(id) * RAND()) FROM `$dbtable_questions` WHERE category = '". strtolower( strval( $category ) ) ."') ORDER BY id LIMIT 1;";
    return Get_single_question($sql);
}

function Get_question_random(){
    require 'db_config.php';  
    $sql = "SELECT * FROM `$dbtable_questions` WHERE id >= (SELECT FLOOR( MAX(id) * RAND()) FROM `$dbtable_questions` ) ORDER BY id LIMIT 1;";
    return Get_single_question($sql);
}   

function Get_single_question($sql){
    require 'question.php';
    require 'db_config.php';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $conn->close();
            return new Question($row["category"], $row["first_alternative"], $row["first_alternative_count"], $row["second_alternative"], $row["second_alternative_count"]);
        }
    } else {
        $conn->close();
        return NULL;
    }
}
    
?>