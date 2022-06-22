<?php
global $App;

if (isset($App->urlParams->code)) {
    foreach ($App->blocks as $block) {
        if ($block->code === $App->urlParams->code) {
            $result = [
                'page' => $App->urlParams->page ?? false,
                'code' => $block->code,
                'title' => $block->title,
                'params' => json_decode(json_encode($block->params), true)
            ];

            if (isset($App->urlParams->page)) {
                foreach ($App->site->pages as $page) {
                    if ($page->isThisPage($App->urlParams->page)) {
                        foreach ($page->blocks as $block) {
                            if ($block->isThisBlock($App->urlParams->code)) {

                                foreach ($result['params'] as $resCode => &$resParam) {
                                    foreach ($block->params as $code => $param) {
                                        if ($resCode === $code) {
                                            $resParam['default'] = json_decode(json_encode($param), true);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

        }
    }
}