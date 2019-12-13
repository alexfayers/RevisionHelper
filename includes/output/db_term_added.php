<?php

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
}
if (isset($_POST)) {
    $definition = $_POST['definition'];
}

$db = new database();

$db->query('INSERT INTO terms(keyword, definition) VALUES (:keyword, :definition)');
$db->bind(':keyword',$keyword);
$db->bind('definition',$definition);

$db->execute();

// front end

$notice = "Keyword '$keyword' added!";
include_once('add_term.php');
