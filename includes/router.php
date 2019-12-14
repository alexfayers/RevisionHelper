<?php

$tab = isset($_GET['page']) ? $_GET['page'] : '';

switch($tab) {
    default:
        include_once('output/main_menu.php');
        break;

    // term add, remove, and edit stuff

    case 'add_term':
        include_once('output/add_term.php');
        break;

    case 'term_added':
        include_once('output/db_term_added.php');
        break;

    case 'remove_term':
        include_once ('output/db_term_deleted.php');
        break;

    // terms show stuff

    case 'show_all_terms':
        include_once('output/show_all_terms.php');
        break;

    // learning stuff!

    case 'flashcards':
        include_once('output/flashcards.php');
        break;

    case 'learn':
        include_once ('output/learn.php');
        break;
}