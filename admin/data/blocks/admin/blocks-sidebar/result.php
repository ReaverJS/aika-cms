<?php
global $App;

$result = [
    'blocks' => $App->blocks,
    'currentCode' => $App->urlParams->code ?? false
];