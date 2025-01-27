<!DOCTYPE html>
<html lang="pl_PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuwanie fast</title>
</head>
<body>
    <h2>Lista zakupów</h2>
    <form action="usuwaniebruh.php" method="post">
        Nazwa<input type="text" name="nazwa"><br>
        Ilość<input type="number" name="ilosc" min="1" max="999"><br>
        <input type="submit" name="submit">
    </form>
    <hr>
</body>
</html>

<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $conn = new PDO('mysql:host=localhost;dbname=zakupy;charset=utf8;port=3306', 'root', '');

    if(isset($_POST['nazwa']) && isset($_POST['ilosc'])){

        $sql = $conn->prepare('INSERT INTO produkty(id, nazwa, ilosc) VALUES (NULL, :nazwa, :ilosc)');
        $sql->bindParam(':nazwa', $_POST['nazwa'], PDO::PARAM_STR);
        $sql->bindParam(':ilosc', $_POST['ilosc'], PDO::PARAM_INT);
        $sql->execute();

    }

    if(isset($_POST['usun_id'])){

        $sql = $conn->prepare('DELETE FROM produkty WHERE id = :id');
        $sql->bindParam(':id', $_POST['usun_id'], PDO::PARAM_INT);
        $sql->execute();

    }

    $sql = $conn->query('SELECT * FROM produkty');

    echo "<table>";

    foreach($sql as $row){

        echo "<tr>";

        echo "<td>" . $row['nazwa'] . "</td><td>" . $row['ilosc'] . "</td><td>";

        echo "<form action='usuwaniebruh.php' method='post'>
        <input type='hidden' name='usun_id' value='" . $row['id'] . "'>
        <button type='submit' name='usun'>x</button>
        </form>";

        echo "</td></tr>";

    }

    echo "</table>";

    $conn = NULL;

}

?>