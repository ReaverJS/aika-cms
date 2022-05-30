<?php

class Page {
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
}