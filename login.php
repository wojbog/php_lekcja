<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie dziennik</title>
</head>

<body>
    <h1>LOGOWANIE</h1>
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
                header("location:admin_panel.php");
            } else {
                echo "błędne hasło";
            }
        }
        $connect->close();
    }
    ?>
</body>

</html>