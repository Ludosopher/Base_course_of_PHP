<?php
session_start();

const MSG = 'msg';

include __DIR__ . '/lib.php';

$html = file_get_contents(__DIR__ . '/main.html');
$content = getContent();
if (!empty($content)) {
    echo str_replace(['{{CONTENT}}', '{{MSG}}', '{{COUNT}}'], 
    [$content, getMsg(), countBasket()], 
    $html);
}
