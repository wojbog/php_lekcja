<?php
$error = "NIe udało się wykonać operacji";
if (isset($_GET['id'])) {
    require "./connect.php";
    print_r($_POST);
    $sql = "UPDATE `oceny` SET `id_przedmiotu`=$_POST[id_przedmiotu],`ocena`=$_POST[ocena],`data_aktualizacji`=default WHERE id=$_GET[id];";
    $connect->query($sql);
    if ($connect->affected_rows) {
        $error = "Zaktualizowano ocenę";
    }
}
header("location: ./../nau_panel.php?error=$error");
