<?php
    require_once __DIR__ . "/vendor/autoload.php";
    $connection = new MongoDB\Client("mongodb://127.0.0.1/");
    //$connection = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $database = $connection -> dbforlabs;
    $collection = $database -> library; 
?>