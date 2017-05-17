<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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

function tanuloTabla($limit) {
    $kapcsolat = adatbazisKapcsolat();
    echo '<table>';
    echo '<tr>';
    echo '<th>tazon</th>';
    echo '<th>nev</th>';
    echo '<th>szak</th>';
    echo '</tr>';
    $lekerdezes = "SELECT tazon, nev, szak FROM tanulo LIMIT $limit";
    $eredmeny = mysqli_query($kapcsolat, $lekerdezes);
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

function ujSor() {
    echo szovegMezo("ujnev", "Név");
    br(1);
    echo szovegMezo("ujszak", "Szak");
    br(1);
    echo ujGomb("hozzaadas", "Hozzáadás");
}

function hozzaad($nev, $szak) {
    $kapcsolat = adatbazisKapcsolat();
    $hozzaadasSQL = "INSERT INTO tanulo (nev, szak) VALUES ('" . $nev . "', '" . $szak . "')";
    //echo $hozzaadasSQL;
    $eredmeny = mysqli_query($kapcsolat, $hozzaadasSQL);
    echo $eredmeny;
    adatbazisLezaras($kapcsolat);
}

?>
