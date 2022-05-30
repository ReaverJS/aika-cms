<?php
global $App;

if (isset($App->urlParams->url)) {
    foreach ($App->site->pages as $page) {
        if ($page->url === $App->urlParams->url) {
            $result = [
                'url' => $page->url,
                'title' => $page->title,
                'meta' => (array) $page->meta,
                'blocks' => (array) $page->blocks
            ];
        }
    }
}