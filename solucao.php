<?php

if (empty($_GET['defeito'])) {
  echo '[]';
  die;
}

$defeito = $_GET['defeito'];

$array = [];

$i = 0;

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


$dburl = parse_url(getenv("CLEARDB_DATABASE_URL"));

$link = mysqli_connect($dburl["host"], $dburl["user"], $dburl["pass"], substr($dburl["path"], 1));
if (!$link) {
  die('Não foi possível conectar: ' . mysql_error());
}

$query = "select id, solucao from solucao where id_defeito = " . $defeito . ";";

$result = mysqli_query($link, $query);

$keys = ['id', 'solucao'];

while ($row = mysqli_fetch_row($result)) {
  $row = array_map('utf8_encode', $row);

  $array[$i] = array_combine($keys, $row);
  $i++;
}

echo json_encode($array);

mysqli_close($link);
