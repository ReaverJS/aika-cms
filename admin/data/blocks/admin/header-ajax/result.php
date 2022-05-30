<?php
global $App;

$result = [
    'title' => $App->properties->title,
    'currentUrl' => explode('?', $_SERVER['REQUEST_URI'])[0]
];