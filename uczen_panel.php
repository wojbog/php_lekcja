<?php
session_start();
if (isset($_SESSION['user']) && isset($_SESSION['user_typ']) && ($_SESSION['user_typ'] == "admin" || $_SESSION['user_typ'] == "nauczyciel" || $_SESSION['user_typ'] == "uczen")) {
} else {
    header("location: ./index.php");
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Panel Ucznia</title>
</head>

<body>
    <header>
        <?php
        echo "<h1>Witaj " . $_SESSION['user_name'] . "</h1>";
        ?>
        <h1>PANEL UCZNIA</h1>
        <a href="./script/logout.php">
            <div class="guzik">Wyloguj</div>
        </a>
    </header>
    <main>
        <div class="contener">
            <table>
                <tr>
                    <th>Lp.</th>
                    <th>przedmiot</th>
                    <th>ocena</th>
                    <th>data dodania</th>
                    <th>data aktualizacji</th>
                </tr>
                <?php
                require_once "./script/connect.php";
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                } else {
                    $id = $_SESSION['user'];
                }
                $_SESSION['id_uczen'] = $id;
                //pagination
                $_SESSION['page'] = 0;
                $_SESSION['page_size'] = 3;
                $sql2 = "select count(*) from oceny join przedmioty on oceny.id_przedmiotu=przedmioty.id where id_ucznia=$id";
                $result2 = $connect->query($sql2);
                $ile = $result2->fetch_row()[0];
                if (isset($_GET['page_size'])) {
                    if ($_GET['page_size'] == 3 || $_GET['page_size'] == 5 || $_GET['page_size'] == 8 || $_GET['page_size'] == 10) {
                        $_SESSION['page_size'] = $_GET['page_size'];
                    } else {
                        $_SESSION['page_size'] = 3;
                    }
                }
                $table_size = $_SESSION['page_size'];
                $ile_stron = round($ile / $table_size);
                if (isset($_GET['page'])) {
                    if ($_GET['page'] >= 0 && $_GET['page'] < $ile_stron) {
                        $_SESSION['page'] = $_GET['page'];
                    }
                }
                $page = $_SESSION['page'];
                $page_number = $page * $table_size;
                $sql = "select nazwa as przedmiot, ocena, data_dodania, data_aktualizacji from oceny join przedmioty on oceny.id_przedmiotu=przedmioty.id where id_ucznia=$id limit $page_number,$table_size";
                $result = $connect->query($sql);
                $lp = 1;
                while ($row = $result->fetch_assoc()) {
                    echo <<<ROW
        <tr>
            <td>$lp</td>
            <td>$row[przedmiot]</td>
            <td>$row[ocena]</td>
            <td>$row[data_dodania]</td>
            <td>$row[data_aktualizacji]</td>
        </tr>
ROW;
                    $lp++;
                }

                $connect->close();

                ?>
            </table>
            <span>pokazuj: </span>
            <select name="" id="table_size" onchange='zmiana()'>
                <?php
                $arr = array(3, 5, 8, 10);
                foreach ($arr as $value) {
                    if ($value == $_SESSION['page_size']) {
                        echo "<option value='$value' selected>$value</option>";
                    } else {
                        echo "<option value='$value'>$value</option>";
                    }
                }
                ?>
            </select>
            <button><a href="?id=<?php echo $_SESSION['id_uczen']; ?>&page=<?php echo $_SESSION['page'] - 1; ?>&page_size=<?php echo $_SESSION['page_size']; ?>">poprzedni</a></button>
            <span><?php echo $_SESSION['page'] ?></span>
            <button><a href="?id=<?php echo $_SESSION['id_uczen']; ?>&page=<?php echo $_SESSION['page'] + 1; ?>&page_size=<?php echo $_SESSION['page_size']; ?>">następny</a></button>
        </div>
    </main>
    <footer>
        Pracę wykonał: Wojciech Bogacz 4c
    </footer>
    <script>
        function zmiana() {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('page_size', document.getElementById('table_size').value);
            window.location.search = urlParams;
        }
    </script>
</body>

</html>