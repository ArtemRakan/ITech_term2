<?php
    require_once("connect.php");

    $y_start = $_POST['y_start'];
    $y_end = $_POST['y_end'];

    $stmt=$dbh->prepare("SELECT L.LITERATE AS 'Type of literature', L.NAME AS 'Name', L.YEAR AS 'Publication year', L.DATE AS 'Publication date (newspapers only)', 
                         L.PUBLISHER AS 'Publisher', L.ISBN AS 'ISBN (books only)', L.NUMBER AS 'Article number (magazine only)', L.PAGESCOUNT AS 'Pages count' 
                         FROM LITERATURE AS L 
                         WHERE L.YEAR >= ? AND L.YEAR <= ?");
    $stmt->execute(array($y_start,$y_end));
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
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