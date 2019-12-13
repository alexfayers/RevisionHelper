<?php

$form_submit = '?page=term_added';

$keyword_length = '20';
$definition_length = '500';

$page = <<< PAGE
<h2>Add term</h2>
<form action=$form_submit method="post" enctype='multipart/form-data'>
    <h3>Term keyword:</h3>
    <input type="text" name="keyword" maxlength="$keyword_length" size="$keyword_length"
     placeholder="Example" required>
    <h3>Term definition:</h3>
    <textarea rows="10" cols="50" name="definition" maxlength="$definition_length" 
    placeholder="A thing characteristic of its kind or illustrating a general rule." required></textarea>
    <h3>Image (optional):</h3>
    <input type="file" name="image">
    
    <input type="submit">
</form>
PAGE;

include_once 'generateHTML.php';