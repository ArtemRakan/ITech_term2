<?php
    require_once("connect.php");

    $action = $_POST["publisher"];
    $stmt = $dbh->prepare("SELECT L.NAME AS 'Name of the book', L.YEAR AS 'Publication date', L.PUBLISHER AS 'Publisher', ISBN, L.PAGESCOUNT AS 'Count of pages' 
                           FROM LITERATURE AS L 
                           WHERE L.PUBLISHER = ? ");
    $stmt->execute(array($action));
    $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
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
    print "<a href='index.php'>Вернутся на главную страницу</a>";
?>