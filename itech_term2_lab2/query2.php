<?php
    header("Cache-Control: no-cache, must-revalidate");

    require_once("connect.php");

    $receiver1 = $_REQUEST['y_start']."-01-01 00:00:00";
    $start = new MongoDB\BSON\UTCDateTime(strtotime($receiver1)*1000);

    $receiver2 = $_REQUEST['y_end']."-12-31 23:59:59";
    $end = new MongoDB\BSON\UTCDateTime(strtotime($receiver2)*1000);

    $cursor = $collection -> find(['date' => ['$gte' => $start , '$lte' => $end ]],['projection' => ['_id' => 0, 'item' =>  1 , 'articleTitle' => 1, 'bookTitle' => 1, 'author' => 1, 'publisherName' => 1]]);
    $result = iterator_to_array($cursor);

    foreach($result as $row){
        $item = $row['item'];
        if($item == 'book'){
            $bookTitle = $row['bookTitle'];
            $author = $row['author'];
            $publisherName = $row['publisherName'];
            print "<ul><li>Type of literature : $item</li>";
            print "<li>Book title : $bookTitle</li>";
            print "<li>Author : $author</li>";
            print "<li>Publisher : $publisherName</li></ul>";
        }
        elseif ($item == 'magazine') {
            $magazineTitle = $row['articleTitle'];
            $publisherName = $row['publisherName'];
            print "<ul><li>Type of literature : $item</li>";
            print "<li>Magazine article title : $magazineTitle</li>";
            print "<li>Publisher : $publisherName</li></ul>";
        }
        else {
            $newspaperTitle = $row['articleTitle'];
            $publisherName = $row['publisherName'];
            print "<ul><li>Type of literature : $item</li>";
            print "<li>Newspaper article title : $newspaperTitle</li>";
            print "<li>Publisher : $publisherName</li></ul>";
        }
    }
?>