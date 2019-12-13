<?php

$tab = isset($_GET['page']) ? $_GET['page'] : '';

switch($tab) {
    default:
        include_once('output/main_menu.php');
        break;

    case 'add_term':
        include_once('output/add_term.php');
        break;

    case 'term_added':
        include_once('output/db_term_added.php');
        break;

    case 'show_all_terms':
        include_once('output/show_all_terms.php');
        break;
}