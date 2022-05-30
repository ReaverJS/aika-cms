<?php
global $App;

if (isset($App->urlParams->url)) {
    foreach ($App->site->pages as $page) {
        if ($page->url === $App->urlParams->url) {
            $result = [
                'blocks' => json_decode(json_encode($page->blocks),  true)
            ];
        }
    }
}