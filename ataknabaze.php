<!DOCTYPE html>
<html lang="pl_PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacking bazy</title>
    <style>

        table, tr, th, td{
            border: solid black 2px;
            border-collapse: collapse;
        }

        input{
            border: none;
            border-bottom: solid purple 2px;
        }

    </style>
</head>
<body>
    <h2>Pokaz Testy: </h2>
    <form method="post">
        <input type="text" name="id" placeholder="przedmiot"><br>
        <input type="submit" name="submit">
    </form><br>
</body>
</html>

<?php

$pdo = new PDO('mysql:host=localhost;dbname=szkola4tig1;charset=utf8mb4', 'root', '');


// ! "DROP TABLE test"

$id = $_POST['id'];

$stmt = $pdo->query("SELECT * FROM `test` WHERE id <= " . $id);

$przedmioty = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<table>
        <tr><th>ID</th><th>Przedmiot</th></tr>';

foreach($przedmioty as $row){

    echo '<tr><td>' . $row['id'] . '</td>';

    echo '<td>' . $row['nazwa'] . '</td></tr>';

}

echo '</table><br>';

?>

<!-- SQL

CREATE TABLE test (
id INT PRIMARY KEY AUTO_INCREMENT,
nazwa varchar(100) NOT NULL
);


INSERT INTO test VALUES (NULL, "geografia"),
(NULL, "j.polski");



-->