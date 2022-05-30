<?php
global $App;

if (isset($App->urlParams->code)) {
    foreach ($App->blocks as $block) {
        if ($block->code === $App->urlParams->code) {
            $params = [];
            foreach ($block->params as $code=>$param) {
                if (isset($param->default)) $params[$code] = $param->default;
            }
            $result = [
                'code' => $block->code,
                'title' => $block->title,
                'params' => (array) $block->params,
                'defaultParams' => $params
            ];
        }
    }
}