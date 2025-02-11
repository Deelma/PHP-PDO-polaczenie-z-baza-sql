<!DOCTYPE html>
<html lang="pl_PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj pytanie</title>
</head>
<body>

</body>
</html>
<?php

$PDO = new PDO('mysql:hostname=localhost;dbname=quiz_4tig1;charset=utf8mb4;port=3306', 'root', '');

$stmt = $PDO->prepare('SELECT id, tresc FROM pytanie');

$stmt->execute();

foreach($stmt as $row){

    echo '<a href="edytuj_pytanie.php?id=' . $row['id'] . '">' . $row['tresc'] . '</a><br>';

}

if($_SERVER['REQUEST_METHOD'] == "GET"){

    if(isset($_GET['id'])){

        $stmt = $PDO->prepare('SELECT * FROM pytanie WHERE id = :id');

        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);

        $stmt->execute();

        foreach($stmt as $row){

            echo '<h2>Edytuj pytanie:</h2>
        <form method="post">
            <textarea name="Pytanie" placeholder="Pytanie" id="pytanko">' . $row['Tresc'] . '</textarea><br><br>
            <textarea name="Odp_A" placeholder="Odpowiedź A">' . $row['Odp_A'] . '</textarea><input type="radio" name="Odp" class="odpowiedz" value="A"><br>
            <textarea name="Odp_B" placeholder="Odpowiedź B">' . $row['Odp_B'] . '</textarea><input type="radio" name="Odp" class="odpowiedz" value="B"><br>
            <textarea name="Odp_C" placeholder="Odpowiedź C">' . $row['Odp_C'] . '</textarea><input type="radio" name="Odp" class="odpowiedz" value="C"><br>
            <textarea name="Odp_D" placeholder="Odpowiedź D">' . $row['Odp_D'] . '</textarea><input type="radio" name="Odp" class="odpowiedz" value="D"><br>
            <input type="submit" name="submit">
        </form>';

        }
    }

}




?>