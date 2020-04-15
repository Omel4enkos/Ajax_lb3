<?php
session_start();
header('Content-Type: application/json');
header("Cache-Control: no-cache, must-revalidate");
require_once 'connect.php';
if(isset( $_GET['authors'] ) )
{
    $author = $_GET['authors'];
    $select = $dbh->prepare('SELECT literature.name as "book", literature.isbn, literature.publisher,
    literature.year, literature.quantity, authors.name FROM literature INNER JOIN book_authors ON book_authors.fid_book = literature.id_book
    INNER JOIN authors on authors.id_author = book_authors.fid_authors WHERE authors.name = :name');
    $select->execute(array(':name' => $author));
    $table = $select->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($table);
}