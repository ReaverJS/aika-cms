<?php
global $App;

$sections = [];
$pages = [];
foreach ($App->site->pages as $page) {
    $arUrl = array_filter(explode('/', $page->url));

    $section = count($arUrl) ? '/' . $arUrl[1] : '/';

    $sections[$section]['url'] = $section;
    $sections[$section]['pages'][] = $page;
}

$result = [
    'sections' => $sections,
    'currentUrl' => $App->urlParams->url ?? false
];