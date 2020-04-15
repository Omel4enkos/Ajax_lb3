<?php
require_once 'connect.php';
$select = $dbh->prepare('SELECT authors.name FROM authors');
$select->execute();
$table = $select->fetchAll(PDO::FETCH_ASSOC);
$array = array();
foreach ($table as $item) {
    $array[]= $item['name'];
}
$_SESSION['authors'] = $array;
