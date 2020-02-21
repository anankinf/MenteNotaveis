<?php

require_once("../Activity.php");
require_once("../connection.php");

$id = $_GET['id'] ?? null;

$activity = new Activity($mysqli);
$activity->delete($id);
header('location: /');
die();


