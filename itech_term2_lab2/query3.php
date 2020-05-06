<?php
    header("Cache-Control: no-cache, must-revalidate");

    require_once("connect.php");

    $action = $_REQUEST['author'];

    $cursor = $collection -> find(['author'=>$action],['projection'=>['_id'=>0]]);
    $result = iterator_to_array($cursor);

    print "<table border=\"1\">\n";
    print "<tr>\n";

    foreach($result[0] as $key => $useless){
        print "<th>$key</th>";
    }
    
    print "</tr>";
    foreach($result as $row){
        print "<tr>";
        foreach($row as $key => $val){
            if(is_string($val)){
                print "<td>$val</td>";
            }
            else if(is_numeric($val)){
                print "<td>$val</td>";
            }
            else if(!is_countable($val)){
                $date = $val->toDateTime()->format("Y");
                print "<td>$date</td>";

            }
            else{
                print "<td>";
                for($i=0; $i<count($val);$i++){
                    $temp = $val[$i]."<br>";
                    print "$temp";
                }
                print "</td>";
            }
        }
        print "</tr>";
    }
    print "</table>";
?>