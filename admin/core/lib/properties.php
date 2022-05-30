<?php

class Properties {
    public array $scripts = [];
    public array $styles = [];
    public array $meta = [];
    public string $title = '';

    function addScript($script) {
        array_push($this->scripts, $script);
    }

    function addStyle($style) {
        array_push($this->styles, $style);
    }

    function addMeta($name, $content) {
        $this->meta[$name] = $content;
    }

    function setTitle($title) {
        $this->title = $title;
    }
}