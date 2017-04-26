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
            ?>
        </form>
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
?>