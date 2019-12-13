<?php

$db = new database();

$db->query('SELECT keyword_number, keyword, definition FROM terms');
$rows = $db->resultArray(); // get all terms and definitions

$allTerms = '';
if ($db->rowCount() === 0) {
    $allTerms .= '<tr>';
    $allTerms .= '<th>' . 'No Keywords Available' .'</th>';
    $allTerms .= '<th>' . 'No Definitions Available' . '</th>';
    $allTerms .= '<th>' . '<button class="deleteTermButton" disabled>Remove Term</button>' . '</th>';
    $allTerms .= '</tr>';
}
else {
    foreach ($rows as $term) {
        $termID = $term['keyword_number'];
        $allTerms .= '<tr>';
        $allTerms .= '<th>' . $term['keyword'] .'</th>';
        $allTerms .= '<th>' . $term['definition'] . '</th>';
        $allTerms .= <<< BUTTON
<th><button class="deleteTermButton" id="$termID" onclick="return delete_term('$termID')">Remove Term</button></th>
BUTTON;
        $allTerms .= '</tr>';
    }
}



$page = <<< PAGE
<h2>All terms</h2>
<p>Here's a list of all of your terms!</p>
<table style='width:50%'>
$allTerms
</table>
PAGE;

include_once 'generateHTML.php';