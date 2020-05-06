<!DOCTYPE html>
<html>
<head>
    <title>ITech_Term2_Lab1</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="style/lib1.png">
</head>
<body>
    <h3>First task. Вывести информацию о книгах указанного издательства.</h3>
    <form method="POST" action="query1.php">
        <label for="publisher">Выберите издательство:</label>
        <select name="publisher" id="publisher">
            <?php
                require_once("connect.php");
                $sqlPublishers = "SELECT DISTINCT L.PUBLISHER FROM LITERATURE AS L WHERE L.PUBLISHER is NOT NULL";
                foreach($dbh->query($sqlPublishers) as $row)
                {
                    echo "<option value=$row[0]>$row[0]</option>";
                }
            ?>
        </select>
        <input type="submit" value="Просмотреть список">
    </form>

    <h3>Second task. Вывести информацию о изданной литературе за указанный промежуток времени.</h3>
    <form method="POST" action="query2.php">
        <h4>Укажите начальный и конечный год для поиска литературы (выбор доступен только из определённого перечня дат, присущих имеющейся литературе):</h4>
        <label for = "y_start">Вывести список литературы начиная с </label>
        <select name = "y_start">
            <?php
                require_once("connect.php");
                $sqlStart = "SELECT DISTINCT L.YEAR FROM LITERATURE AS L";
                foreach($dbh->query($sqlStart) as $row){
                    echo "<option value=$row[0]>$row[0]</option>";
                }
            ?>
        </select>
        <label for = "y_end"> по </label>
        <select name = "y_end">
            <?php
                require_once("connect.php");
                $sqlStop = "SELECT DISTINCT L.YEAR FROM LITERATURE AS L";
                foreach($dbh->query($sqlStop) as $row){
                    echo "<option value=$row[0]>$row[0]</option>";
                }
            ?>
        </select>
        <input type="submit" value="Просмотреть список">
    </form>

    <h3>Third task. Вывести нформацию о книгах определенного автора.</h3>
    <form method="POST" action="query3.php">
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
        <input type="submit" value="Просмотреть список">
    </form>

    <h3>Not a task<h3>
    <form method="POST" action="test.php">
        <input type="submit" value="phpinfo()">
    </form>
    
</body>
</html>