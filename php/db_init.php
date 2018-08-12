<?php

function Initialize_database(){
    require 'db_config.php';
    
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS " . $dbname;
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error creating database: " . $conn->error;
        return false;
    }
}

function Initialize_tables(){
    require 'db_config.php';
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    // sql to create table  
    $sql = "CREATE TABLE questions (
    id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    category VARCHAR(30) NOT NULL,
    first_alternative VARCHAR(140) NOT NULL,
    first_alternative_count INT(6) NOT NULL DEFAULT 0,
    second_alternative VARCHAR(140) NOT NULL,
    second_alternative_count INT(6) NOT NULL DEFAULT 0,
    created_by INT(6) NOT NULL DEFAULT 0,
    created_at DATE NOT NULL
    )";
    
    if ($conn->query($sql) === TRUE) {
        //echo "Table MyGuests created successfully";
        return true;
    } else {
        //echo "Error creating table: " . $conn->error;
        return false;
    }
}


function Seed_data($alt1, $alt2, $category){
    require 'db_config.php';
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    $sql = "INSERT INTO $dbtable_questions (category, first_alternative, second_alternative, created_at) VALUES ('" . strtolower( strval( $category ) ). "', '". strval( $alt1 ) . "', '". strval( $alt2 ) . "', now())";
    
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
    $conn->close(); //fuck does this do? we return before reaching this point
}

if(Initialize_database()){
    echo "\nDB created successfully";
} else {
    echo "\nfailure in creating db";
}

if(Initialize_tables()){
    echo "\nTables created successfully";
} else {
    echo "\nfailure in creating tables";
}

if(Seed_data("Fotball", "Tennis", "sport")){
    echo "\nrandom data injected";
} else {
    echo "\nfailure in generating test data";
}

if(Seed_data("Beer", "Wine", "food")){
    echo "\nrandom data injected";
} else {
    echo "failure in generating test data";
}

if(Seed_data("Samsung", "Apple", "technology")){
    echo "\nrandom data injected";
} else {
    echo "\nfailure in generating test data";
}

?>