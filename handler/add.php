<?php

require "../dbBroker.php";
require "../model/pozicija.php";
require "../model/fudbaler.php";
require "../model/zemlja.php";

if (
    isset($_POST['ime']) && isset($_POST['prezime']) &&  $_POST['brojDresa']
    && isset($_POST['pozicija']) && isset($_POST['zemlja'])
) {
    $pozicija = Pozicija::getByName($_POST['pozicija'], $conn)->fetch_array();
    $zemlja = Zemlja::getByName($_POST['zemlja'], $conn)->fetch_array();

    $fudbaler = new fudbaler(null, $_POST['ime'], $_POST['prezime'], $_POST['brojDresa'] ,$pozicija['idPozicija'], $zemlja['idZemlje']);
    $status = fudbaler::add($fudbaler, $conn);
    if ($status) {
        echo 'Success';
    } else {
        echo $status;
        echo 'Failed';
    }
}
