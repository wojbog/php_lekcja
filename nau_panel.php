<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel nauczyciela</title>
</head>

<body>
    <h1>PANEL NAUCZYCIELA</h1>


    <h2>DODAJ OCENĘ</h2>
    <?php
    if (isset($_GET['error'])) {
        echo "<h4>" . $_GET["error"] . "</h4>";
    }
    require "./script/connect.php";
    ?>
    <form action="./script/dodaj_ocene.php" method="post">
        <select name="id_ucznia">
            <?php
            $sql = 'select id,imie,nazwisko from user where typ="uczen";';
            $result = $connect->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='$row[id]'>$row[imie] $row[nazwisko]</option>";
            }
            ?>
        </select>
        <select name="id_przedmiotu">
            <?php
            $sql = 'select * from przedmioty;';
            $result = $connect->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='$row[id]'>$row[nazwa]</option>";
            }
            ?>
        </select>
        <select name="ocena" id="">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>
        <input type="submit" name="dodaj_ocene" value="Dodaj">
    </form>
    <?php
    $connect->close();
    ?>
    <h2>OCENY:</h2>
    <table>
        <tr>
            <th>imie i nazwisko</th>
            <th>ocena</th>
            <th>przedmiot</th>
            <th>data dodania</th>
            <th>data aktualizacji</th>
            <th></th>
            <th></th>
        </tr>
        <?php
        $connect = new mysqli("localhost", "root", "", "dziennik");
        $sql = "select oceny.id as id, imie, nazwisko,ocena, nazwa as przedmiot, data_dodania,data_aktualizacji from user join oceny on oceny.id_ucznia=user.id join przedmioty ON oceny.id_przedmiotu=przedmioty.id;";
        $result = $connect->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo <<<WIERSZ
            <tr>
            <td>$row[imie] $row[nazwisko]</td>
            <td>$row[ocena]</td>
            <td>$row[przedmiot]</td>
            <td>$row[data_dodania]</td>
            <td>$row[data_aktualizacji]</td>
            <td><a href="./script/delete_mark.php?id=$row[id]">Usuń</a></td>
            <td><a href="./nau_panel.php?id_ocena=$row[id]">aktualizuj</a></td>                      
            </tr>
WIERSZ;
        }
        $connect->close();
        ?>
        <?php
        if (isset($_GET['id_ocena'])) {
            $connect = new mysqli("localhost", "root", "", "dziennik");
            $sql = "select imie, nazwisko,ocena,nazwa as przedmiot from user join oceny on oceny.id_ucznia=user.id join przedmioty ON oceny.id_przedmiotu=przedmioty.id where oceny.id=$_GET[id_ocena];";
            $result = $connect->query($sql);
            $row = $result->fetch_assoc();
            $imie = $row['imie'];
            $nazwisko = $row['nazwisko'];
            $przedmiot = $row['przedmiot'];
            $ocena = $row['ocena'];
            $oceny_arr = array(1, 2, 3, 4, 5, 6);
            $oceny_arr = array_diff($oceny_arr, array($ocena));
            array_unshift($oceny_arr, $ocena);
            $sql = "Select * from przedmioty;";
            $result = $connect->query($sql);
            echo <<<AKTU
                    <form action="./script/update_mark.php?id=$_GET[id_ocena]" method='post'>
                    <label>imie: $imie </label><br>
                    <label>nazwisko: $nazwisko </label><br>
                   ocena: <select name="ocena">
AKTU;
            foreach ($oceny_arr as $value) {
                echo "<option value=$value>$value</option>";
            }
            echo "</select><br>";
            echo "przedmiot: <select name='id_przedmiotu'>";
            while ($row = $result->fetch_assoc()) {
                if ($row['nazwa'] == $przedmiot) {
                    echo "<option value=$row[id] selected>$row[nazwa]</option>";
                } else {
                    echo "<option value=$row[id]>$row[nazwa]</option>";
                }
            }
            echo "</select><br>";
            echo <<<AKTU
                    <input type="submit" name="aktualizuj_ocene" value="Aktualizuj">
                </form>
AKTU;
            $connect->close();
        }
        ?>

</body>

</html>