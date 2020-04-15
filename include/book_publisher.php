<?php
session_start();
require_once 'connect.php';
$publisher = $_REQUEST['publisher'];
$select_book = $dbh->prepare('SELECT literature.name as "Title", literature.isbn, literature.publisher, literature.year,
    literature.quantity, authors.name FROM literature INNER JOIN book_authors on book_authors.fid_book = literature.id_book
    INNER JOIN authors on authors.id_author = book_authors.fid_authors WHERE literature.publisher = :publisher');
$select_book->execute(array(':publisher' => $publisher));
//$table = $select_book->fetchAll(PDO::FETCH_ASSOC);

$table = $select_book->fetchAll(PDO::FETCH_NUM);
foreach ($table as $row){
    $title = $row[0];
    $isbn = $row[1];
    $publish = $row[2];
    $year = $row[3];
    $quantity = $row[4];
    $name = $row[5];
    print "<tr><td>$title</td><td>$isbn</td><td>$publish</td><td>$year</td><td>$quantity</td><td>$name</td></tr>";
}