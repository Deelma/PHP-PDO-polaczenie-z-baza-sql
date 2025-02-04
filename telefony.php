<!DOCTYPE html>
<html lang="pl_PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telefony</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

</body>
</html>

<?php

$PDO = new PDO('mysql:host=localhost;dbname=telefony;charset=utf8mb4;port=3306', 'root', '');

$stmt = $PDO->prepare('SELECT * FROM telefon');

$stmt->execute();

echo '<table>';

echo '<tr><th>Marka</th><th>Model</th></tr>';

// ? Foreachem

// foreach($stmt as $row){

//     echo '<tr><td>' . $row['marka'] . '</td><td>' . $row['model'] . '</td></tr>';

// }


// ? While'm

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    echo '<tr><td>' . $row['marka'] . '</td><td>' . $row['model'] . '</td></tr>';

}

echo "</table><br>";

$stmt = $PDO->prepare('SELECT COUNT(*) FROM telefon');

$stmt->execute();

echo "W bazie jest tyle telefonów: " . $stmt->fetch()[0];

?>