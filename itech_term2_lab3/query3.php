<?php
    header('Content-Type: application/json');
    header("Cache-Control: no-cache, must-revalidate");

    require_once("connect.php");

    $author = $_REQUEST['author'];

    $stmt=$dbh->prepare("SELECT A.NAME AS 'Author name', L.NAME AS 'Book name', L.YEAR AS 'Publication year', L.PUBLISHER AS 'Publisher', L.ISBN AS 'ISBN', L.PAGESCOUNT AS 'Pages count' 
                         FROM AUTHORS AS A INNER JOIN BOOK_AUTHOR AS BA ON A.ID_AUTHOR = BA.FID_AUTHOR INNER JOIN LITERATURE AS L ON BA.FID_BOOK = L.ID_LITERATURE 
                         WHERE A.NAME = ? ");
    $stmt->execute(array($author));
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
?>