<?php
$error = "NIE UDAŁO SIĘ WYKONAĆ OPERACJI";
if (isset($_POST['aktualizuj'])) {
    $connect = new mysqli("localhost", "root", "", "dziennik");
    $sql = "UPDATE `user` SET `imie`='$_POST[imie]',`nazwisko`='$_POST[nazwisko]',`data_urodzenia`='$_POST[data_urodzenia]',`email`='$_POST[email]' WHERE id=$_GET[id]";
    $connect->query($sql);
    if ($connect->affected_rows) {
        $error = "Zaktualizowano użytkownika";
    } else {
        $error = "NIe zaktualizowano użytkownika!!!";
    }
    $connect->close();
}
header("location: ./../admin_panel.php?err=$error");
