<?php

class Page
{
    public string $url;
    public string $title;
    public stdClass $meta;
    public array $blocks = [];

    function __construct($stdObject)
    {
        $this->url = $stdObject->url ? $stdObject->url : null;
        $this->title = $stdObject->title ? $stdObject->title : null;
        $this->meta = $stdObject->meta ? $stdObject->meta : null;

        foreach ($stdObject->blocks as $block) {
            $this->blocks[] = new Block($block);
        }
    }

    function isThisPage($url)
    {
        return ($this->url === $url);
    }

    function moveBlock($code, $dir)
    {
        foreach ($this->blocks as $index => $block) {
            if ($block->isThisBlock($code)) {
                if ($dir === 'up') {
                    $out = array_splice($this->blocks, $index, 1);
                    array_splice($this->blocks, $index - 1, 0, $out);
                } else {
                    $out = array_splice($this->blocks, $index + 1, 1);
                    array_splice($this->blocks, $index, 0, $out);
                }
            }
        }
    }

    function deleteBlock($code)
    {
        foreach ($this->blocks as $index => $block) {
            if ($block->isThisBlock($code)) {
                unset($this->blocks[$index]);
            }
        }
    }

    function saveBlocks($page)
    {

    }
}