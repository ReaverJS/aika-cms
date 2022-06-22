<?php
global $App;
$curPage = $App->urlParams->page ?? false;
$curCode = $App->urlParams->code ?? false;

if ($curPage && $curCode) {
    foreach ($App->site->pages as $page) {
        if ($page->isThisPage($curPage)) {
            $block = new stdClass();
            $block->code = $curCode;
            $block->title = 'Тестовый компонент';
            $block->params = new stdClass();
            $page->blocks[] = new Block($block);
            $App->site->save();
        }
    }
}

$result = [
    'blocks' => $App->blocks,
    'page' =>  $curPage,
    'code' => $curCode
];