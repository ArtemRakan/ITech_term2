<?php
    require_once("connect.php");

    $publisher = $_REQUEST["publisher"];

    $stmt = $dbh->prepare("SELECT L.NAME AS 'Name of the book', L.YEAR AS 'Publication date', L.PUBLISHER AS 'Publisher', ISBN, L.PAGESCOUNT AS 'Count of pages' 
                           FROM LITERATURE AS L 
                           WHERE L.PUBLISHER = ? ");
    $stmt->execute(array($publisher));
    $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

    if($result == null){
        exit("User data not found or does not exist");
    }
    
    print "<table border=\"1\">\n";
    print "<tr>\n";
    foreach($result[0] as $key => $useless){
        print "<th>$key</th>";
    }
    print "</tr>";
    foreach($result as $row){
        print "<tr>";
        foreach($row as $key => $val){
            print "<td>$val</td>";
        }
        print "</tr>";
    }
    print "</table>";
?>