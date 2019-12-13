<?php

$db = new database();

$db->query('SELECT keyword, definition FROM terms');
$rows = $db->resultArray(); // get all terms and definitions

$allTerms = '';
foreach ($rows as $term) {
    $allTerms .= '<tr>';
    $allTerms .= '<th>' . $term['keyword'] .'</th>';
    $allTerms .= '<th>' . $term['definition'] . '</th>';
    $allTerms .= '</tr>';
}

$page = <<< PAGE
<h2>All terms</h2>
<p>Here's a list of all of your terms!</p>
<table style='width:50%'>
$allTerms
</table>
PAGE;

include_once 'generateHTML.php';