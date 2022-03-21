<?php
$err = "NIE udało się wykonać operacji!!!";
if (isset($_GET['id'])) {
    require "./connect.php";
    $sql = "DELETE FROM `oceny` WHERE id=$_GET[id];";
    $connect->query($sql);
    if ($connect->affected_rows) {
        $err = "Usunęto ocenę";
    }
}
header("location: ./../nau_panel.php?error=$err");
