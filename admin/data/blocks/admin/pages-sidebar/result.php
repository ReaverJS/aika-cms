<?php
global $App;

$sections = [];
$pages = [];
foreach ($App->site->pages as $page) {
    $arUrl = array_filter(explode('/', $page->url));
    sort($arUrl);
    $section = count($arUrl) ? '/' . $arUrl[0] : '/';

    $sections[$section]['url'] = $section;
    $sections[$section]['pages'][] = $page;
}

$result = [
    'sections' => $sections,
    'currentUrl' => $App->urlParams->url ?? false
];