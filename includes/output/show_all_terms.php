<?php

$db = new database();

$db->query('SELECT keyword_number, keyword, definition, image FROM terms');
$rows = $db->resultArray(); // get all terms, definitions, and images

$allTerms = '';

$allTerms .= '<th>' . 'Keyword' .'</th>';
$allTerms .= '<th>' . 'Definition' .'</th>';
$allTerms .= '<th>' . 'Image' .'</th>';
$allTerms .= '<th>' . 'Remove Term' .'</th>';

if ($db->rowCount() === 0) {
    $allTerms .= '<tr>';
    $allTerms .= '<td style="color: grey;">' . 'No Keywords Available' .'</td>';
    $allTerms .= '<td style="color: grey;">' . 'No Definitions Available' . '</td>';
    $allTerms .= '<td style="color: grey;">No Image Available</td>';
    $allTerms .= '<td>' . '<button class="deleteTermButton" disabled>Remove Term</button>' . '</td>';
    $allTerms .= '</tr>';
}
else {
    foreach ($rows as $term) {
        $termID = $term['keyword_number'];
        $allTerms .= '<tr>';
        $allTerms .= '<td>' . $term['keyword'] .'</td>';
        $allTerms .= '<td>' . $term['definition'] . '</td>';

        if (isset($term['image'])) {
            $imageWidth = '10%';
            $image = $term['image'];
            $imgSource = '/uploads/' . $image;
            $allTerms .= '<td><img src="' . $imgSource . '" width="' . $imageWidth . '"></td>';
        }
        else {
            $allTerms .= '<td>No image</td>';
        }

        $allTerms .= <<< BUTTON
<td><button class="deleteTermButton" id="$termID" onclick="return delete_term('$termID')">Remove Term</button></td>
BUTTON;
        $allTerms .= '</tr>';
    }
}



$page = <<< PAGE
<h2>All terms</h2>
<p>Here's a list of all of your terms!</p>
<table style='width:50%; text-align:center'>
$allTerms
</table>
PAGE;

include_once 'generateHTML.php';