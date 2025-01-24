<!DOCTYPE html>
<html lang="pl_PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista zakupów</title>
    <style>
        
        #guzik{
            border: none;
            border-radius: 50%;
            background-color: red;
            color: white;
            float: right;
        }

        #guzik:hover{
            background-color: #ff5f5f;
        }

        input{
            border: none;
            border-bottom: solid purple 2px;
        }

        input:hover{
            background-color: white;
        }

        #linia{
            height: 3px;
            width: 300px;
            float: left;
            background-color: purple;
        }

        hr{
            width: 300px;
            float: left;
        }
        
        tr::before{
            content: "*";
        }
        

    </style>
</head>
<body>
    <form action="listazakupow.php" method="post">
        Dodaj produkt: <input type="text" name="produkt"><br>
        Wybierz ilość: <input type="number" min="0" max="999" name="ilosc"><br>
        <input type="submit" value="Dodaj"><br><br>
    </form>
    <hr id="linia"><br><br>
    <p>Lista Zakupów:</p>
    <hr><br>
    <table>
    <?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $pdo = new PDO('mysql:host=localhost;dbname=szkola4tig1;charset=utf8mb4', 'root', '');

        if(!empty($_POST['produkt']) && !empty($_POST['ilosc']) && empty($_POST['edytuj_id'])){

            $sql = $pdo->prepare('INSERT INTO produkty (id, nazwa, ilość) VALUES (NULL, :produkt, :ilosc)');

            $sql->bindParam(':produkt', $_POST['produkt'], PDO::PARAM_STR);

            $sql->bindParam(':ilosc', $_POST['ilosc'], PDO::PARAM_INT);

            $sql->execute();
        }

        if(!empty($_POST['usun_id'])){
            
            $sql = $pdo->prepare('DELETE FROM produkty WHERE id = :id');
            
            $sql->bindParam(':id', $_POST['usun_id'], PDO::PARAM_INT);
            
            $sql->execute();
        }

        if(!empty($_POST['edytuj_id']) && !empty($_POST['produkt']) && isset($_POST['ilosc'])){
            
            $sql = $pdo->prepare('UPDATE produkty SET nazwa = :produkt, ilość = :ilosc WHERE id = :id');
            
            $sql->bindParam(':produkt', $_POST['produkt'], PDO::PARAM_STR);
            
            $sql->bindParam(':ilosc', $_POST['ilosc'], PDO::PARAM_INT);
            
            $sql->bindParam(':id', $_POST['edytuj_id'], PDO::PARAM_INT);
            
            $sql->execute();
        }

        if(!empty($_POST['edytuj_id']) && empty($_POST['produkt']) && !isset($_POST['ilosc'])){
            
            $sql = $pdo->prepare('SELECT * FROM `produkty` WHERE id = :id');
            
            $sql->bindParam(':id', $_POST['edytuj_id'], PDO::PARAM_INT);
            
            $sql->execute();

            foreach ($sql as $row){
            
                echo '<form action="listazakupow.php" method="post">
                Edycja produktu: <input type="text" name="produkt" value="' . $row["nazwa"] . '">
                Zmień ilość: <input type="number" min="0" max="999" name="ilosc" value="' . $row["ilość"] . '">
                <input type="hidden" name="edytuj_id" value="' . $row["id"] . '">
                <input type="submit" value="Edytuj"><br><br>
                </form>';
            
            }
        }

        $sql = $pdo->query('SELECT * FROM `produkty` ORDER BY `nazwa` ASC');
        
        foreach($sql as $row){
            
            echo '<tr>';
            
            echo '<td>' . $row['nazwa'] . ' | ' . $row['ilość'] . '</td>';
            
            echo '<td id="guzik"><form action="listazakupow.php" method="post">
            <input type="hidden" name="usun_id" value=\'' . $row["id"] . '\'>
            <button type="submit" id="guzik"><strong>x</strong></button>
            </form></td>';
            
            echo '<td><form action="listazakupow.php" method="post">
            <input type="hidden" name="edytuj_id" value=\'' . $row["id"] . '\'>
            <button type="submit">Edytuj</button>
            </form></td>';
            
            echo '</tr>';
        }
    }
    
?>

    </table>
</body>
</html>
