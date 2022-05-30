<?php
global $App;

if (isset($App->urlParams->code)) {
    foreach ($App->blocks as $block) {
        if ($block->code === $App->urlParams->code) {
            $result = [
                'code' => $block->code,
                'title' => $block->title,
                'params' => json_decode(json_encode($block->params), true)
            ];
        }
    }
}