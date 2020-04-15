<?php
session_start();
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
require_once 'connect.php';
$first_year = $_REQUEST['first_year'];
$last_year = $_REQUEST['last_year'];
$first_date = $_REQUEST['first_date'];
$last_date = $_REQUEST['last_date'];

$select = $dbh->prepare('SELECT literature.name as "litname", literature.date, literature.year,literature.publisher, literature.quantity,
    literature.isbn, literature.number, literature.literate, authors.name FROM literature LEFT JOIN resource
    ON resource.id_resource = literature.fid_resource LEFT JOIN book_authors on book_authors.fid_book = literature.id_book
    LEFT JOIN authors on authors.id_author = book_authors.fid_authors where literature.year BETWEEN :first_year and :last_year
    or DATE(literature.date) BETWEEN :first_date AND :last_date');
$select->execute(array(':first_year' => $first_year, ':last_year' => $last_year, ':first_date' =>$first_date, ':last_date'=>$last_date));
$table = $select->fetchAll(PDO::FETCH_NUM);
echo '<?xml version="1.0" encoding="utf8" ?>';
echo "<root>";
if(!empty($table)){
    foreach ($table as $item) {
        $litname = $item[0];
        $litdate = $item[1];
        $lityear = $item[2];
        $litpublish = $item[3];
        $litquantity = $item[4];
        $litisbn = $item[5];
        $litnumber = $item[6];
        $litliterate = $item[7];
        $author_name = $item[8];
        print "<row><litname>$litname</litname><litdate>$litdate</litdate><lityear>$lityear</lityear><litpublish>$litpublish</litpublish>
                <litquantity>$litquantity</litquantity><litisbn>$litisbn</litisbn><litnumber>$litnumber</litnumber><litliterate>$litliterate</litliterate>
                <author_name>$author_name</author_name></row>";
    }
    echo "</root>";
}
else{
    echo 'Нет данных с такими годами';
}

