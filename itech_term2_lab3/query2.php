<?php
    header('Content-Type: text/xml');
    header("Cache-Control: no-cache, must-revalidate");

    require_once("connect.php");

    $y_start = $_REQUEST['y_start'];
    $y_end = $_REQUEST['y_end'];

    $stmt=$dbh->prepare("SELECT L.LITERATE AS 'Type of literature', L.NAME AS 'Name', L.YEAR AS 'Publication year', L.DATE AS 'Publication date (newspapers only)', 
                         L.PUBLISHER AS 'Publisher', L.ISBN AS 'ISBN (books only)', L.NUMBER AS 'Article number (magazine only)', L.PAGESCOUNT AS 'Pages count' 
                         FROM LITERATURE AS L 
                         WHERE L.YEAR >= ? AND L.YEAR <= ?");
    $stmt->execute(array($y_start,$y_end));
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<?xml version="1.0" encoding="utf8" ?>';
    echo "<query2>";
    print "<row>\n";
    foreach($result[0] as $key => $useless){
        print "<headers>$key</headers>";
    }
    echo "</row>";
    foreach($result as $row){
        print "<row>";
        foreach($row as $key => $val){
            print "<def>$val</def>";
        }
        print "</row>";
    }
    echo "</query2>"
?>