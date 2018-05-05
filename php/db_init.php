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
    $sql = "CREATE DATABASE IF NOT EXISTS pwa_questions";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
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


?>