<?php

require_once("../Activity.php");
require_once("../connection.php");



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $insert = $_POST;
    $activity = new Activity($mysqli);

    $activity->insert($insert);

    header('location: /modules/edit.php?id=' . $insert['module_id']);

    die();
}

?>