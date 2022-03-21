<?php
$error = "NIE UDAŁO SIĘ WYKONAĆ OPERACJI";
if (isset($_GET['id'])) {
    echo "elo mordo";
    $connect = new mysqli("localhost", "root", "", "dziennik");
    $sql = "DELETE FROM `user` WHERE `id`=$_GET[id];";
    $result = $connect->query($sql);
    if ($connect->affected_rows) {
        $error = "Usunięto użytkownika";
    } else {
        $error = "NIE usunięto użytkownika!!!";
    }
    $connect->close();
}
header("location: ./../admin_panel.php?err=$error");
