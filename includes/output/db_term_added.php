<?php

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
}
if (isset($_POST)) {
    $definition = $_POST['definition'];
}

$notice = '';

$db = new database();

if (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['name'])) { // uploading image

    $name = $_FILES['image']['name'];
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    // Check extension
    if (in_array($imageFileType,$extensions_arr)) {
        $db->query('INSERT INTO terms(keyword, definition, image) VALUES (:keyword, :definition, :image)');
        $db->bind(':image',$name);
        $db->bind(':keyword',$keyword);
        $db->bind(':definition',$definition);

        if (move_uploaded_file($_FILES['image']['tmp_name'],$target_dir.$name)) {
            $notice = "Keyword '$keyword' added (with file '$name')!";
            $noticeColour = 'green';
        }
        else {
            $notice = "There was an error uploading your file!";
            $noticeColour = 'red';
        }
    }
    else {
        $notice = "Oops! You can't upload that type of file!";
        $noticeColour = 'red';
    }
}
else { // not uploading image
    $db->query('INSERT INTO terms(keyword, definition) VALUES (:keyword, :definition)');
    $db->bind(':keyword',$keyword);
    $db->bind(':definition',$definition);

    $notice = "Keyword '$keyword' added successfully!";
    $noticeColour = 'green';
}

$db->execute();

if ($notice === '') {
    $notice = 'A database error occurred!';
    $noticeColour = 'red';
}


// front end

include_once('add_term.php');
