<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Logowanie dziennik</title>
</head>

<body>
    <header>
        <h1>LOGOWANIE</h1>
    </header>
    <main>
        <div class="contener">
            <form method="post">
                <label>Podaj E-Mail: </label><br>
                <input type="email" name="email" placeholder="Podaj imie"><br>
                <label>Podaj hasło: </label><br>
                <input type="password" name="haslo" placeholder="Podaj hasło"><br>
                <input type="submit" name="zatwierdz" value="zaloguj się"><br>
            </form>
            <?php
            if (isset($_POST["zatwierdz"])) {
                $connect = new mysqli("localhost", "root", "", "dziennik");
                $sql = "SELECT * FROM `user` WHERE `email`='$_POST[email]';";
                $result = $connect->query($sql);
                if (!$result->num_rows) {
                    echo "Błędny E-MAIL!";
                } else {

                    $row = $result->fetch_assoc();
                    if (password_verify($_POST['haslo'], $row['haslo'])) {
                        echo <<<zal
                ZALOGOWANO!!!<br>
                imię: $row[imie]<br>
                nazwisko: $row[nazwisko]<br>
                data urodzenia: $row[data_urodzenia]<br>
                e-mail: $row[email]<br>
zal;
                        session_start();
                        $_SESSION['user'] = $row['id'];
                        $_SESSION['user_name'] = $row['imie'];
                        $_SESSION['user_typ'] = $row['typ'];
                        $connect->close();
                        if ($_SESSION['user_typ'] == "admin") {
                            header("location:admin_panel.php");
                        } else if ($_SESSION['user_typ'] == "nauczyciel") {
                            header("location:nau_panel.php");
                        } else {
                            header("location:uczen_panel.php");
                        }
                    } else {
                        echo "błędne hasło";
                    }
                }
                $connect->close();
            }
            ?>
        </div>
    </main>
    <footer>
        Pracę wykonał: Wojciech Bogacz 4c
    </footer>
</body>

</html>