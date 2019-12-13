<?php

if (isset($_GET['term'])) {
    $keywordID = $_GET['term'];

    $db = new database();

    $db->query('SELECT keyword FROM terms WHERE keyword_number=:keywordID');
    $db->bind(':keywordID',$keywordID);
    $keyword = $db->single(); // get keyword name in order to show to user later
    $keyword = $keyword['keyword'];

    $db->query('DELETE FROM terms WHERE keyword_number=:keywordID');
    $db->bind(':keywordID',$keywordID);
    $db->execute(); // remove keyword


    // front end

    $notice = "Keyword '$keyword' Removed!";
    $noticeColour = 'red';
}
include_once('show_all_terms.php');
