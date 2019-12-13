<?php

require_once 'links.php';

if (!isset($notice)) { // no notice
    $notice = '';
    $noticeColour = '';
}
else {
    if (!isset($noticeColour)) { // default notice colour
        $noticeColour = 'yellow';
    }

    $notice = <<< NOTICE
<p style="color: $noticeColour">$notice</p>
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
