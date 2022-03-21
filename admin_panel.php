<?php
session_start();
if (isset($_SESSION['user'])) {
    echo "zalogowano";
    echo "<h1>Witaj " . $_SESSION['user_name'] . "</h1>";
} else {
    echo "włamanie";
    header("location: ./index.php");
}
echo '<a href="./script/logout.php">Wyloguj</a>';

?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin Panel</title>
</head>

<body>
    <?php

    if (isset($_GET['err'])) {
        echo "<h1>" . $_GET['err'] . "</h1>";
    }
    ?>
    <h1>Nauczyciele</h1>

    <?php
    $connect = new Mysqli("localhost", "root", "", "dziennik");
    $sql = "SELECT * FROM `user` WHERE typ like 'nauczyciel';";
    $result = $connect->query($sql);
    echo <<<TABLE
<table>
<tr>
    <th>id</th>
    <th>imie</th>
    <th>nazwisko</th>
    <th>data_urodzenia</th>
    <th>email</th>
    <th></th>
    <th></th>
</th>
TABLE;
    while ($row = $result->fetch_assoc()) {
        echo <<<wiersz
<tr>
    <td>$row[id]</td>
    <td>$row[imie]</td>
    <td>$row[nazwisko]</td>
    <td>$row[data_urodzenia]</td>
    <td>$row[email]</td>
    <td><a href="./script/delete.php?id=$row[id]">Usuń</a></td>
    <td><a href="./admin_panel.php?aktu_nau=$row[id]">aktualizuj</a></td>
</tr>
wiersz;
    }
    echo "</table>";
    $connect->close();
    ?>
    <a href="./admin_panel.php?dodaj_nau=true">Dodaj nauczyciela</a>
    <?php
    if (isset($_GET['dodaj_nau'])) {
        $imie = "";
        $nazwisko = "";
        $data_urodzenia = "";
        $email = "";
        $czy = 0;
        if (isset($_POST["zatwierdz"])) {
            if (empty($_POST['imie']) || empty($_POST['nazwisko']) || empty($_POST['data_urodzenia']) || empty($_POST['haslo']) || empty($_POST['email'])) {
                $czy = true;
                $imie = $_POST['imie'];
                $nazwisko = $_POST['nazwisko'];
                $data_urodzenia = $_POST['data_urodzenia'];
                $email = $_POST['email'];
            } else {
                $connect = new mysqli("localhost", "root", "", "dziennik");
                $pass = password_hash($_POST['haslo'], PASSWORD_DEFAULT);
                $sql = "INSERT INTO `user`(`imie`, `nazwisko`, `data_urodzenia`, `haslo`, `email`,`typ`) VALUES ('$_POST[imie]','$_POST[nazwisko]','$_POST[data_urodzenia]','$pass','$_POST[email]','nauczyciel');";
                $result = $connect->query($sql);
                if ($connect->affected_rows) {
                    echo "Dodano użytkownika<br>";
                    $czy = 2;
                } else {
                    echo "Nie dodano użytkownika<br>Spróbuj ponownie później!!!";
                }
                $connect->close();
            }
        }
        echo <<<FORM1
    <form name="" method="post">
        <label>Podaj imę: </label><br>
        <input type="text" name="imie" placeholder="Podaje imie" value='$imie'><br>
        <label>Podaj nazwisko:</label><br>
        <input type="text" name="nazwisko" placeholder="Podaj nazwisko" value='$nazwisko'><br>
        <label>Podaj datę urodzenia:</label><br>
        <input type="date" name="data_urodzenia" value='$data_urodzenia'><br>
        <label>Podaj hasło:</label><br>
        <input type="password" name="haslo" placeholder="Podaj hasło"><br>
        <label>Podaj E-mail: </label><br>
        <input type="email" name="email" placeholder="Podaj E-mail" value='$email'><br>
        <input type="submit" name="zatwierdz" value="Zatwierdź"><br>
    </form>
FORM1;
        if ($czy) {
            echo "Wypełnij wszystkie pola!!!";
        } else if ($czy == 2) {
            echo "Dodano nauczyciela!<br>";
        }
    }
    if (isset($_GET['aktu_nau'])) {
        $connect = new mysqli("localhost", "root", "", "dziennik");
        $sql = "SELECT * FROM `user` WHERE `id`=$_GET[aktu_nau];";
        $result = $connect->query($sql);
        $row = $result->fetch_assoc();
        $imie = $row['imie'];
        $nazwisko = $row['nazwisko'];
        $data_urodzenia = $row['data_urodzenia'];
        $email = $row['email'];
        echo <<<FORM1
        <form action="./script/aktualizuj.php?id=$_GET[aktu_nau]" method="post">
            <label>Podaj imę: </label><br>
            <input type="text" name="imie" placeholder="Podaje imie" value='$imie'><br>
            <label>Podaj nazwisko:</label><br>
            <input type="text" name="nazwisko" placeholder="Podaj nazwisko" value='$nazwisko'><br>
            <label>Podaj datę urodzenia:</label><br>
            <input type="date" name="data_urodzenia" value='$data_urodzenia'><br>
            <label>Podaj E-mail: </label><br>
            <input type="email" name="email" placeholder="Podaj E-mail" value='$email'><br>
            <input type="submit" name="aktualizuj" value="Aktualizuj"><br>
        </form>
    FORM1;
        $connect->close();
    }
    ?>

    <h2>Uczniowie</h2>
    <?php
    $connect = new Mysqli("localhost", "root", "", "dziennik");
    $sql = "SELECT * FROM `user` WHERE typ like 'uczen';";
    $result = $connect->query($sql);
    echo <<<TABLE
<table>
<tr>
    <th>id</th>
    <th>imie</th>
    <th>nazwisko</th>
    <th>data_urodzenia</th>
    <th>email</th>
    <th></th>
    <th></th>
</th>
TABLE;
    while ($row = $result->fetch_assoc()) {
        echo <<<wiersz
<tr>
    <td>$row[id]</td>
    <td>$row[imie]</td>
    <td>$row[nazwisko]</td>
    <td>$row[data_urodzenia]</td>
    <td>$row[email]</td>
    <td><a href="./script/delete.php?id=$row[id]">Usuń</a></td>
    <td><a href="./admin_panel.php?aktu_uczen=$row[id]">aktualizuj</a></td>
</tr>
wiersz;
    }
    echo "</table>";
    $connect->close();
    ?>
    <a href="./admin_panel.php?dodaj_uczen=true">Dodaj ucznia</a>
    <?php
    if (isset($_GET['dodaj_uczen'])) {
        $imie_uczen = "";
        $nazwisko_uczen = "";
        $data_urodzenia_uczen = "";
        $email_uczen = "";
        $czy_uczen = 0;
        if (isset($_POST["zatwierdz"])) {
            if (empty($_POST['imie']) || empty($_POST['nazwisko']) || empty($_POST['data_urodzenia']) || empty($_POST['haslo']) || empty($_POST['email'])) {
                $czy_uczen = true;
                $imie_uczen = $_POST['imie'];
                $nazwisko_uczen = $_POST['nazwisko'];
                $data_urodzenia_uczen = $_POST['data_urodzenia'];
                $email_uczen = $_POST['email'];
            } else {
                $connect = new mysqli("localhost", "root", "", "dziennik");
                $pass = password_hash($_POST['haslo'], PASSWORD_DEFAULT);
                $sql = "INSERT INTO `user`(`imie`, `nazwisko`, `data_urodzenia`, `haslo`, `email`,`typ`) VALUES ('$_POST[imie]','$_POST[nazwisko]','$_POST[data_urodzenia]','$pass','$_POST[email]','uczen');";
                $result = $connect->query($sql);
                if ($connect->affected_rows) {
                    echo "Dodano użytkownika<br>";
                    header("location: ./admin_panel.php");
                    $czy = 2;
                } else {
                    echo "Nie dodano użytkownika<br>Spróbuj ponownie później!!!";
                }
                $connect->close();
            }
        }
        echo <<<FORM1
    <form name=""  method="post">
        <label>Podaj imę: </label><br>
        <input type="text" name="imie" placeholder="Podaje imie" value='$imie_uczen'><br>
        <label>Podaj nazwisko:</label><br>
        <input type="text" name="nazwisko" placeholder="Podaj nazwisko" value='$nazwisko_uczen'><br>
        <label>Podaj datę urodzenia:</label><br>
        <input type="date" name="data_urodzenia" value='$data_urodzenia_uczen'><br>
        <label>Podaj hasło:</label><br>
        <input type="password" name="haslo" placeholder="Podaj hasło"><br>
        <label>Podaj E-mail: </label><br>
        <input type="email" name="email" placeholder="Podaj E-mail" value='$email_uczen'><br>
        <input type="submit" name="zatwierdz" value="Zatwierdź"><br>
    </form>
FORM1;
        if ($czy_uczen) {
            echo "Wypełnij wszystkie pola!!!";
        } else if ($czy_uczen == 2) {
            echo "Dodano ucznia!<br>";
        }
    }
    if (isset($_GET['aktu_uczen'])) {
        $connect = new mysqli("localhost", "root", "", "dziennik");
        $sql = "SELECT * FROM `user` WHERE `id`=$_GET[aktu_uczen];";
        $result = $connect->query($sql);
        $row = $result->fetch_assoc();
        $imie = $row['imie'];
        $nazwisko = $row['nazwisko'];
        $data_urodzenia = $row['data_urodzenia'];
        $email = $row['email'];
        echo <<<FORM1
        <form action="./script/update.php?id=$_GET[aktu_uczen]" method="post">
            <label>Podaj imę: </label><br>
            <input type="text" name="imie" placeholder="Podaje imie" value='$imie'><br>
            <label>Podaj nazwisko:</label><br>
            <input type="text" name="nazwisko" placeholder="Podaj nazwisko" value='$nazwisko'><br>
            <label>Podaj datę urodzenia:</label><br>
            <input type="date" name="data_urodzenia" value='$data_urodzenia'><br>
            <label>Podaj E-mail: </label><br>
            <input type="email" name="email" placeholder="Podaj E-mail" value='$email'><br>
            <input type="submit" name="aktualizuj" value="Aktualizuj"><br>
        </form>
    FORM1;
        $connect->close();
    }
    ?>


</body>

</html>