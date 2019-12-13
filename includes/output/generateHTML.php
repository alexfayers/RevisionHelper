<?php
// page templates
require_once 'templates/header.php';
require_once 'templates/body.php';
require_once 'templates/footer.php';

$body=str_replace(':page:',$page,$body);

$output = '';

$output .= $header;
$output .= $body;
$output .= $footer;

echo $output;

$notice = ''; // clear any notices so they don't stay