<?php
session_start();
require_once 'include/publisher.php';
require_once 'include/select-author.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа №3</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/table.css">
    <script src="include/main.js"></script>
</head>

<body>
<div class="Top-text">
    <p><u>Вариант 0</u>. Создать и заполнить произвольными данными БД для хранения информации об информационных ресурсах библиотеки.<br> </p>
    <p>Сформировать запросы, которые будут выводить на экран информацию о:<br></p>

</div>
<div class="dropdown">
    <div class="dropdown-content">
        <div class="Ul">
            <ol class="ol">
                <li>книгах указанного издательства;</li>
                <li>книгах, журналах и газетах, опубликованных за указанный временной период (учитывать год издания);</li>
                <li>книгах указанного автора;</li>
            </ol>
        </div>
    </div>
</div>
<div class="box">

    <div class = "select">
        <label for="publisher"><b>Выберите издательство:</b> </label>
        <select name="publisher" class="select-publisher" id="publish">
            <option hidden disabled selected>Виды:</option>
            <?php
            for($i=0;$i<count($_SESSION['publisher']);$i++):?>
                <option value="<?=$_SESSION['publisher'][$i]?>"><?=$_SESSION['publisher'][$i]?></option>
            <?php endfor; ?>

        </select><br>
        <div class="div-btn">
            <input type="button" class="select-btn" value="Выбрать" onclick="First()">
        </div>
    </div>

    <div class = "select">
        <label for="year"><b>Выберите период издания:</b><br></label>
        <div class="div-year">
            <select class="select-year" name="year[]" id="year" multiple>
                <?php for($i = 2000; $i <= date('Y'); $i++): ?>
                    <option value="<?=$i?>"><?=$i?></option>
                <?php endfor; ?>
            </select><br>
        </div>
        <div class="year-btn">
            <input type="button" class="select-btn" value="Выбрать" onclick="Second()">
        </div>
    </div>

    <div class = "select">
        <label for="authors"><b>Выберите необходимого автора:</b><br></label>
        <div class="div-year">
            <select name="authors" class="select-author" id="author">
                <option hidden disabled selected>Автор:</option>
                <?php
                for($i=0;$i<count($_SESSION['authors']);$i++):?>
                    <option value="<?=$_SESSION['authors'][$i]?>"><?=$_SESSION['authors'][$i]?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="div-btn">
            <input type="button" class="select-btn" value="Выбрать" onclick="Third()">
        </div>
    </div>
</div>

<p class="msg none" id="msg">Some Error</p>

<div class="margin"></div>
<table class="book-table none" id="book-table">
    <thead>
    <tr>
        <th>Название</th>
        <th>Номер</th>
        <th>Издатель</th>
        <th>Год издания</th>
        <th>Страницы</th>
        <th>Автор</th>
    </tr>
    </thead>
    <tbody id="res"></tbody>
</table>

<div class="margin"></div>
<table class="book-table none" id="year-table">
    <thead>
    <tr>
        <th>Название</th>
        <th>Дата</th>
        <th>Год издания</th>
        <th>Издатель</th>
        <th>Страницы</th>
        <th>Номер ISBN</th>
        <th>Номер</th>
        <th>Ресурс</th>
        <th>Автор</th>
    </tr>
    </thead>
    <tbody id="res2"></tbody>
</table>

<div class="margin"></div>
<table class="book-table none" id="author-table">
    <thead>
    <tr>
        <th>Название</th>
        <th>Номер</th>
        <th>Издатель</th>
        <th>Год издания</th>
        <th>Страницы</th>
        <th>Автор</th>
    </tr>
    </thead>
    <tbody id="res3"></tbody>
</table>

</body>
</html>


