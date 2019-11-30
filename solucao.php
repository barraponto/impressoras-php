<?php

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

$query = "select a.id, solucao from solucao as a join defeitos as b on a.id_defeito = b.id where b.id = '" . $defeito . "' ;";

$result = mysqli_query($link, $query);

$keys = ['id', 'solucao'];

while ($rows = mysqli_fetch_row($result)) {

  $array[$i] = array_combine($keys, $rows);
  $i++;

}

echo json_encode($array);

mysqli_close($link);
