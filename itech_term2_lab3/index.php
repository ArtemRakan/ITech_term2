<!DOCTYPE html>
<html>
<head>
    <title>ITech_Term2_Lab3</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="style/lib1.png">
    <script>
        const ajax = new XMLHttpRequest();

        function get1(){
            let publisher =  document.getElementById("publisher").selectedOptions[0].text;
            ajax.open("GET","query1.php?publisher=" + publisher);
            ajax.onreadystatechange = update1;
            ajax.send();
        }

        function update1(){
            if(ajax.readyState === 4){
                if(ajax.status === 200){
                    document.getElementById('body1').innerHTML = ajax.responseText;
                }
            }
        }

        function get2(){
            let y_start = document.getElementById('y_start').value;
            let y_end = document.getElementById('y_end').value;
            ajax.open("GET","query2.php?y_start="+y_start+"&y_end="+y_end);
            ajax.onreadystatechange = update2;
            ajax.send();
        }

        function update2(){
            if(ajax.readyState === 4){
                if(ajax.status === 200){
                    var res = document.getElementById("body2"); 
                    var result = "";
                    if(ajax.responseXML == null){
                        result += "<p>Data not found or does not exist</p>"
                    }
                    else{
                        var rows = ajax.responseXML.firstChild.children;
                        result += "<table border=\"1\">\n"
                        for (var i = 0; i < rows.length; i++) {
                            if(i == rows[0]){
                                result += "<tr>";
                                for(var y = 0; y < rows[0].children.length; y++){
                                    result += "<th>"+rows[0].children[y].textContent+"</th>"
                                }
                                result += "</tr>";
                            }
                            else{
                                result += "<tr>";
                                for(var y = 0; y < rows[i].children.length; y++){
                                    result += "<td>"+rows[i].children[y].textContent+"</td>"
                                }
                                result += "</tr>";
                            }
                        }
                        result += "</table>";
                    }
                }
                res.innerHTML = result;
            }
        }

        function get3(){
            let author = document.getElementById('author').selectedOptions[0].text;
            console.log(author);
            ajax.open("GET","query3.php?author=" + author);
            ajax.onreadystatechange = update3;
            ajax.send();
        }

        function update3(){
            if(ajax.readyState === 4){
                var body3 = document.getElementById("body3");
                if(ajax.status === 200){
                    let result = JSON.parse(ajax.responseText);
                    
                    var columns = [];

                    for(var i = 0; i < result.length; i++){
                        for(var key in result[i]){
                            if(columns.indexOf(key) === -1){
                                columns.push(key);
                            }
                        }
                    }

                    var table = document.createElement("table");
                    table.setAttribute('border', '1');
                    var tr = table.insertRow(-1);
                    for(var i = 0; i < columns.length; i++){
                        var thead = document.createElement("th");
                        thead.innerHTML = columns[i];
                        tr.appendChild(thead);
                    }
                    for(var i = 0; i < result.length; i++){
                        var trow = table.insertRow(-1);
                        for(var j = 0; j < columns.length; j++){
                            var cell = trow.insertCell(-1);
                            cell.innerHTML = result[i][columns[j]];
                        }
                    }
                    var body3 = document.getElementById("body3");
                    body3.innerHTML = "";
                    body3.appendChild(table);
                }
            }
        }


    </script>
</head>
<body>
    <h3>First task. Вывести информацию о книгах указанного издательства.</h3>
    <label for="publisher">Выберите издательство:</label>
    <select name="publisher" id="publisher">
        <?php
            require_once("connect.php");
            $sqlPublisher = "SELECT DISTINCT L.PUBLISHER FROM LITERATURE AS L WHERE L.PUBLISHER is NOT NULL";
            foreach($dbh->query($sqlPublisher) as $row)
            {
                echo "<option value=$row[0]>$row[0]</option>";
            }
        ?>
    </select>
    <input type="button" value="Просмотреть список" onclick="get1()">
    <div id="body1"></div>

    <h3>Second task. Вывести информацию о изданной литературе за указанный промежуток времени.</h3>
    <h4>Укажите начальный и конечный год для поиска литературы (выбор доступен только из определённого перечня дат, присущих имеющейся литературе):</h4>
    <label for = "y_start">Вывести список литературы начиная с </label>
    <select name = "y_start" id = "y_start">
        <?php
            require_once("connect.php");
            $sqlStart = "SELECT DISTINCT L.YEAR FROM LITERATURE AS L";
            foreach($dbh->query($sqlStart) as $row){
                echo "<option value=$row[0]>$row[0]</option>";
            }
        ?>
    </select>
    <label for = "y_end"> по </label>
    <select name = "y_end" id = "y_end">
        <?php
            require_once("connect.php");
            $sqlStop = "SELECT DISTINCT L.YEAR FROM LITERATURE AS L";
            foreach($dbh->query($sqlStop) as $row){
                echo "<option value=$row[0]>$row[0]</option>";
            }
        ?>
    </select>
    <input type="button" value="Просмотреть список" onclick="get2()">
    <div id="body2"></div>

    <h3>Third task. Вывести нформацию о книгах определенного автора.</h3>
    <label for="author">Выберите автора:</label>
    <select name="author" id="author">
        <?php
            require_once("connect.php");
            $sqlAuthor = "SELECT A.NAME FROM AUTHORS AS A";
            foreach($dbh->query($sqlAuthor) as $row)
            {
                echo "<option value=$row[0]>$row[0]</option>";
            }
        ?>
    </select>
    <input type="button" value="Просмотреть список" onclick="get3()">
    <div id="body3"></div> 

</body>
</html>