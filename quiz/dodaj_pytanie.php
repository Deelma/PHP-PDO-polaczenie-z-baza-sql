<!DOCTYPE html>
<html lang="pl_PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj pytanie do quizu</title>
    <style>

        textarea{
            border: none;
            border-bottom: solid purple 2px;
            border-right: solid purple 2px;
            font-size: 15px;
        }

        .odpowiedz{
            width: 20px;
            height: 20px;
        }

        #pytanko{
            border: solid purple 2px;
            font-size: 20px;
        }

    </style>
</head>
<body>
    <h2>Dodaj pytanie do quizu:</h2>
    <form method="post">
        <textarea name="Pytanie" placeholder="Pytanie" id="pytanko"></textarea><br><br>
        <textarea name="Odp_A" placeholder="Odpowiedź A"></textarea><input type="radio" name="Odp" class="odpowiedz" value="A"><br>
        <textarea name="Odp_B" placeholder="Odpowiedź B"></textarea><input type="radio" name="Odp" class="odpowiedz" value="B"><br>
        <textarea name="Odp_C" placeholder="Odpowiedź C"></textarea><input type="radio" name="Odp" class="odpowiedz" value="C"><br>
        <textarea name="Odp_D" placeholder="Odpowiedź D"></textarea><input type="radio" name="Odp" class="odpowiedz" value="D"><br>
        <input type="submit" name="submit">
    </form>
</body>
</html>
<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $PDO = new PDO("mysql:host=localhost;dbname=quiz_4tig1;charset=utf8mb4;port=3306", "root", "");

    if(!empty($_POST['Pytanie']) && isset($_POST['submit'])){

        $stmt = $PDO->prepare('INSERT INTO pytanie(Tresc, Popr_odp, Odp_A, Odp_B, Odp_C, Odp_D) VALUES (:tresc, :popr_odp, :odp_a, :odp_b, :odp_c, :odp_d)');

        $stmt->bindParam(':tresc', $_POST['Pytanie'], PDO::PARAM_STR);
        $stmt->bindParam(':popr_odp', $_POST['Odp'], PDO::PARAM_STR);
        $stmt->bindParam(':odp_a', $_POST['Odp_A'], PDO::PARAM_STR);
        $stmt->bindParam(':odp_b', $_POST['Odp_B'], PDO::PARAM_STR);
        $stmt->bindParam(':odp_c', $_POST['Odp_C'], PDO::PARAM_STR);
        $stmt->bindParam(':odp_d', $_POST['Odp_D'], PDO::PARAM_STR);

        $stmt->execute();

    }
}



?>