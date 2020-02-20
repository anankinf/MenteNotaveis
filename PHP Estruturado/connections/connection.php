<?php

$conn = new mysqli('127.0.0.1:3600', 'root', 'secret', 'mnteste');

if ($conn->connect_errno) {
    die('Falhou em conectar: (' . $conn->connect_errno . ') ' . $conn->connect_error);
}
