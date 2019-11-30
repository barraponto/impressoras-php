<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

$array = [];
$i = 0;

$dburl = parse_url(getenv("CLEARDB_DATABASE_URL"));

$link = mysqli_connect($dburl["host"], $dburl["user"], $dburl["pass"], substr($dburl["path"], 1));
if (!$link) {
  die('Não foi possível conectar: ' . mysql_error());
}

$query = 'SELECT * FROM defeitos;';

$result = mysqli_query($link, $query);

$keys = ['id', 'defeito'];

while ($row = mysqli_fetch_row($result)) {

  $array[$i] = array_combine($keys, $row);
  $i++;

}

echo json_encode($array);

mysqli_close($link);
