<?php
        $db_driver="mysql";
        $host="localhost";
        $dbname="itech2_lw1_v0";
        $username="root";
        $password="";
        $dsn="$db_driver:host=$host;dbname=$dbname";
        try{
            $dbh=new PDO($dsn,$username,$password);
        }
        catch(PDOException $e){
            echo "Database aren`t connected! Error! $e->getMessage()";
        }
    ?>
