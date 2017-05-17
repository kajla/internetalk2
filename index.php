<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if (!isset($_SESSION['poz'])) {
    $_SESSION['poz'] = 0;
    $_SESSION['ssz'] = 2;
} else {
    if (isset($_POST['frissites'])) {
        $_SESSION['ssz'] = $_POST['db'];
    }
}

include 'fvk.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Internetes alkalmazásfejlesztés 2</title>
    </head>
    <body>
        <form method="POST">
            <?php
            if (filter_input(INPUT_POST, "kilep")) {
                echo 'Kilépett';
                session_destroy();
            }
            br(1);
            echo 'POST: ';
            print_r($_POST);
            br(1);
            echo 'GET: ';
            print_r($_GET);
            br(1);
            print_r($_SESSION);
            br(3);
            echo 'Lapméret: ';
            echo szovegMezo("db", $_SESSION['ssz']);
            br(2);

            echo ujGomb("ujhozzaad", "Hozzáadás");
            echo ' ';
            echo ujGomb("frissites", "Frissítés");
            echo ' ';
            echo ujGomb("kilep", "Kilépés");
            br(2);
            echo szovegMezo("szoveg1", filter_input(INPUT_POST, "szoveg1", FILTER_SANITIZE_STRING));
            br(3);
            if (isset($_POST['ujhozzaad'])) {
                ujSor();
            }
            if (isset($_POST['hozzaadas'])) {
                hozzaad($_POST['ujnev'], $_POST['ujszak']);
            }
            ?>
        </form>
        <h3>Táblázat</h3>
        <?php
        tanuloTabla($_SESSION['ssz']);
        ?>
    </body>
</html>
