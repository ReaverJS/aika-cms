<?php
global $App;

if (isset($App->urlParams->code)) {
    foreach ($App->blocks as $block) {
        if ($block->code === $App->urlParams->code) {
            $result = [
                'page' => $App->urlParams->page ?? false,
                'code' => $block->code,
                'title' => $block->title,
                'params' => []
            ];
            if (isset($App->body->action) && ($App->body->action === 'up' || $App->body->action === 'down')) {
                foreach ($App->site->pages as $page) {
                    if ($page->isThisPage($App->urlParams->page)) {
                        $page->moveBlock($App->urlParams->code, $App->body->action);
                        $App->site->save();
                    }
                }
            }

            if (isset($App->body->action) && $App->body->action === 'delete') {
                foreach ($App->site->pages as $page) {
                    if ($page->isThisPage($App->urlParams->page)) {
                        $page->deleteBlock($App->urlParams->code);
                        $App->site->save();
                    }
                }
            }

            if ($App->body && isset($App->body->params)) {
                $result['params'] = (array) $App->body->params;

                if (isset($App->body->action) && $App->body->action === 'save') {
                    foreach ($App->site->pages as $page) {
                        if ($page->isThisPage($App->urlParams->page)) {
                            foreach ($page->blocks as $block) {
                                if ($block->isThisBlock($App->urlParams->code)) {
                                    $block->update($App->body->params);
                                    $App->site->save();
                                }
                            }
                        }
                    }
                }

            } elseif (isset($App->urlParams->page)) {
                foreach ($App->site->pages as $page) {
                    if ($page->isThisPage($App->urlParams->page)) {
                        foreach ($page->blocks as $block) {
                            if ($block->isThisBlock($App->urlParams->code)) {
                                $result['params'] = (array) $block->params;
                            }
                        }
                    }
                }
            } else {
                foreach ($block->params as $code=>$param) {
                    if (isset($param->default)) $result['params'][$code] = $param->default;
                }
            }

        }
    }
}