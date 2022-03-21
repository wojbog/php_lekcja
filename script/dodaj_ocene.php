<?php
$err = "Nie udało się dodać oceny!!!";
if (isset($_POST['dodaj_ocene'])) {
    $connect = new mysqli("localhost", "root", "", "dziennik");
    $sql = "INSERT INTO `oceny`(`id_ucznia`, `id_przedmiotu`, `ocena`) VALUES ($_POST[id_ucznia],$_POST[id_przedmiotu],$_POST[ocena]);";
    $connect->query($sql);
    if ($connect->affected_rows) {
        $err = "dodano ocenę!!!";
    }
    $connect->close();
}
header("location: ./../nau_panel.php?error=$err");
