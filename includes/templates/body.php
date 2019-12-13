<?php

require_once 'links.php';

if (!isset($notice)) { // no notice
    $notice = '';
}
else {
    $notice = <<< NOTICE
<p style="color: green">$notice</p>
NOTICE;
}

$body = <<< BODY
<body>
    <h1>Alex's Revision Helper</h1>
    <hr>
    $links
    <br><hr>
    $notice
    :page:
</body>
BODY;
