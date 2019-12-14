<?php
$linkArray = [
    "Main Menu" => 'main_menu',
    "Add Term" => 'add_term',
    "Term List/Delete Terms" => 'show_all_terms',
    "Flashcards" => 'flashcards',
    "Learn" => 'learn'
];

$links = '';

$numLinks = count($linkArray);
$linkNo = 0;

foreach ($linkArray as $title => $path) {
    $links .= "<a href='?page=$path'>$title</a>";

    if(++$linkNo !== $numLinks) {
        $links .= ' | ';
    }
}