<?php 
    require 'db_init.php';
    $db = Initialize_database();
    $tables = Initialize_tables();

    echo "Database: " . $db;
    echo "Tables: " . $tables;
?>
