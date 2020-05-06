<?php
    require_once("connect.php");
    $author = $_POST['author'];
    $stmt=$dbh->prepare("SELECT A.NAME AS 'Author name', L.NAME AS 'Book name', L.YEAR AS 'Publication year', L.PUBLISHER AS 'Publisher', L.ISBN AS 'ISBN', L.PAGESCOUNT AS 'Pages count' 
                         FROM AUTHORS AS A INNER JOIN BOOK_AUTHOR AS BA ON A.ID_AUTHOR = BA.FID_AUTHOR INNER JOIN LITERATURE AS L ON BA.FID_BOOK = L.ID_LITERATURE 
                         WHERE A.NAME = ? ");
    $stmt->execute(array($author));
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