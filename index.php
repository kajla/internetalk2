<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
                exit();
            }
            echo 'POST: ';
            print_r($_POST);
            br(1);
            echo 'GET: ';
            print_r($_GET);
            br(3);
            echo ujGomb("gomb", "Gomb");
            br(2);
            echo ujGomb("kilep", "Kilépés");
            br(2);
            echo szovegMezo("szoveg1", filter_input(INPUT_POST, "szoveg1", FILTER_SANITIZE_STRING));
            br(3);
            ?>
        </form>
        <h3>Táblázat</h3>
        <?php
        tanuloTabla();
        ?>
    </body>
</html>
<?php

function br(int $sor) {

    for ($i = 0; $i < $sor; $i++) {
        echo '<br />';
    }
}

function ujGomb(string $nev, string $ertek) {
    $gomb = '<input type="SUBMIT" name="' . $nev . '" value="' . $ertek . '" />';
    return $gomb;
}

function szovegMezo(string $nev, $szoveg) {
    if ($szoveg == "") {
        $szoveg = "Kezdeti szöveg";
    }
    $szv = '<input type="text" name="' . $nev . '" value="' . $szoveg . '" />';
    return $szv;
}

function adatbazisKapcsolat() {
    $kapcsolat = mysqli_connect('127.0.0.1', 'root', 'alma', 'tanulok', '3306');
    if (!$kapcsolat) {
        die('Nem sikerült csatlakozni az adatbázishoz: ' . mysqli_connect_error());
    }
    mysqli_query($kapcsolat, 'SET NAMES \'utf8\'');
    return $kapcsolat;
}

function adatbazisLezaras($kapcsolat) {
    mysqli_close($kapcsolat);
}

function tanuloTabla() {
    $kapcsolat = adatbazisKapcsolat();
    echo '<table>';
    echo '<tr>';
    echo '<th>tazon</th>';
    echo '<th>nev</th>';
    echo '<th>szak</th>';
    echo '</tr>';
    $eredmeny = mysqli_query($kapcsolat, 'SELECT tazon, nev, szak FROM tanulo');
    while (($sor = mysqli_fetch_array($eredmeny, MYSQLI_ASSOC)) != NULL) {
        echo '<tr>';
        echo '<td>' . $sor['tazon'] . '</td>';
        echo '<td>' . $sor['nev'] . '</td>';
        echo '<td>' . $sor['szak'] . '</td>';
        echo '</tr>';
    }
    mysqli_free_result($eredmeny);
    echo '</table>';
    adatbazisLezaras($kapcsolat);
}
?>