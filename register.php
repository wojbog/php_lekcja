<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejsetracja dziennik</title>
</head>

<body>
    <h1>REJESTRACJA</h1>

    <?php
    $imie = "";
    $nazwisko = "";
    $data_urodzenia = "";
    $email = "";
    $czy = false;
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
            $sql = "INSERT INTO `user`(`imie`, `nazwisko`, `data_urodzenia`, `haslo`, `email`,`typ`) VALUES ('$_POST[imie]','$_POST[nazwisko]','$_POST[data_urodzenia]','$pass','$_POST[email]','admin');";
            $result = $connect->query($sql);
            if ($connect->affected_rows) {
                echo "Dodano użytkownika<br>";
                echo "<a href='./login.php'>Zaloguj się</a><br>";
                echo "<a href='./index.php'>Przejdź do strony głównej</a><br>";
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
    }
    ?>
</body>

</html>