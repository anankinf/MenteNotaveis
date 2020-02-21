<?php

require_once("../Module.php");
require_once("../connection.php");

$id = $_GET['id'] ?? null;

$module = new Module($mysqli);
$module->delete($id);
header('location: /');
die();

// Ao deletar um módulo o banco de dados se encarregará de excluir todas as Atividades relacioandas a ele devido a chave estrangeira.
