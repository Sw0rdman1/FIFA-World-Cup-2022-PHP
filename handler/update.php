<?php

require "../dbBroker.php";
require "../model/pozicija.php";
require "../model/fudbale.php";
require "../model/zemlja.php";

if (
    isset($_POST['checked-donut']) && isset($_POST['ime']) && isset($_POST['prezime']) && isset($_POST['brojDrresa']) && isset($_POST['pozicija']) && isset($_POST['zemlja'])
) {
    $pozicija = Pozicija::getByName($_POST['pozicija'], $conn)->fetch_array();
    $zemlja = Zemlja::getByName($_POST['zemlja'], $conn)->fetch_array();

    $fudbaler = new fudbaler($_POST['checked-donut'], $_POST['ime'], $_POST['prezime'], $_POST['brojDresa'], $pozicija['idPozicija'], $zemlja['idZemlje']);
    $status = fudbaler::update($fudbaler, $conn);
    if ($status) {
        echo 'Success';
    } else {
        echo $status;
        echo 'Failed';
    }
}
