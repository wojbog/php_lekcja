<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Rejsetracja dziennik</title>
</head>

<body>
    <header>
        <h1>REJESTRACJA</h1>
    </header>
    <main>
        <div class="contener">
            <?php
            // Regex
            $imie = "";
            $imie_pattern = "/^[A-Z]{1}[A-Za-z]{1,29}$/m";
            $nazwisko = "";
            $nazwisko_pattern = "/^[A-Z]{1}[A-Za-z]{1,29}$/m";
            $data_urodzenia = "";
            $email = "";
            $email_pattern = "/^[a-z0-9._-]{1,28}@[a-z.]{1,10}.[a-z]{1,3}$/m";
            $czy = false;
            if (isset($_POST["zatwierdz"])) {
                if (!preg_match($imie_pattern, $_POST['imie']) || !preg_match($nazwisko_pattern, $_POST['nazwisko']) || empty($_POST['data_urodzenia']) || empty($_POST['haslo']) || !preg_match($email_pattern, $_POST['email'])) {
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
                        echo "<div class='contener'>";
                        echo "Dodano użytkownika<br>";
                        echo "<a href='./login.php'><div class='guzik'>Zaloguj się</div></a><br>";
                        echo "<a href='./index.php'><div class='guzik'>Przejdź do strony głównej</div></a><br>";
                        echo "</div>";
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
                echo <<<POLA
        Wypełnij poprawnie wszystkie pola!!!<br>
        Imię - Zaczynamy wielką literą<br>
        Nazwisko - zaczynamy wielką literą<br>
        E-mail - może zawierać literki, cyferki oraz znaki "._-"<br>
POLA;
            }
            ?>
        </div>
    </main>
    <footer>
        Pracę wykonał: Wojciech Bogacz 4c
    </footer>
</body>

</html>