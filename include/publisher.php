<?php
require_once 'connect.php';
$select = $dbh->prepare('SELECT DISTINCT publisher from literature WHERE publisher is NOT null');
$select->execute();
$table = $select->fetchAll(PDO::FETCH_ASSOC);
$rows =$select->rowCount();
$array = array();
foreach ($table as $item) {

    $array[]= $item['publisher'];
}
$_SESSION['publisher'] = $array;
