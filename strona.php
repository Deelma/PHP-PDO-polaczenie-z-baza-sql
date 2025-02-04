<!DOCTYPE html>
<html lang="pl_PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baza</title>
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
    <h2>Dodaj Ucznia: </h2>
    <form action="strona.php" method="post">
        <input type="text" name="imie" placeholder="Imie"><br>
        <input type="text" name="nazwisko" placeholder="Nazwisko"><br>
        <input type="text" name="klasa" placeholder="Klasa"><br>
        <input type="text" name="srednia_ocen" placeholder="Średnia ocen"><br>
        <input type="submit">
    </form><br>
</body>
</html>

<?php

$pdo = new PDO('mysql:host=localhost;dbname=szkola4tig1;charset=utf8mb4', 'root', '');

// Insert przykladowy
// $sql = $pdo->query("INSERT INTO `uczniowie` (`imie`, `nazwisko`, `klasa`, `srednia_ocen`) VALUES ('Karol', 'Samorski', '2TI', 4.89)");

//! Zadanie 2
if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    if(!empty($_POST['imie']) && !empty($_POST['nazwisko']) && !empty($_POST['klasa']) && !empty($_POST['srednia_ocen'])){
        
        $imie = $_POST['imie'];
        
        $nazwisko = $_POST['nazwisko'];
        
        $klasa = $_POST['klasa'];
        
        $srednia_ocen = $_POST['srednia_ocen'];
        
        $dodajucznia = $pdo->prepare("INSERT INTO `uczniowie` (`imie`, `nazwisko`, `klasa`, `srednia_ocen`) VALUES ('$imie', '$nazwisko', '$klasa', '$srednia_ocen')");
        
        $dodajucznia->execute();
        
    }
    if(isset($_POST['submit'])){
        
        echo "<meta http-equiv='refresh' content='0'>"; 
        
    }
}

//! Zadanie 1
$stmt = $pdo->query("SELECT `imie`, `nazwisko`, `klasa`, `srednia_ocen` FROM `uczniowie`");

$uczniowie = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<table>
        <tr><th>Imie</th><th>Nazwisko</th><th>Klasa</th><th>Średnia Ocen</th></tr>';

foreach($uczniowie as $row){
    
    echo '<tr><td>' . $row['imie'] . '</td>';
    
    echo '<td>' . $row['nazwisko'] . '</td>';
    
    echo '<td>' . $row['klasa'] . '</td>';
    
    echo '<td>' . $row['srednia_ocen'] . '</td></tr>';

}

echo '</table><br>';

?>