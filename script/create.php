<?php
if ((isset($_POST["zatwierdz"]))) {
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
            $error = "Dodano użytkownika<br>";
            $czy = 2;
        } else {
            $error = "Nie dodano użytkownika<br>Spróbuj ponownie później!!!";
        }
        $connect->close();
    }
}

header("location: ./../admin_panel.php?err=$error");
