<?php

require "../dbBroker.php";
require "../model/fudbaler.php";

if (
    isset($_POST['id'])
) {
    $fudbaler = new Fudbaler($_POST['id'], null, null,null, null, null);
    $status = $fudbaler->delete($conn);
    if ($status) {
        echo 'Success';
    } else {
        echo $status;
        echo 'Failed';
    }
}
