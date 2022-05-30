<?php

class Block {
    public string $code;
    public string $title;
    public stdClass $params;

    function __construct($stdObject)
    {
        $this->title = $stdObject->title ? $stdObject->title : null;
        $this->code = $stdObject->code ? $stdObject->code : null;
        $this->params = $stdObject->params ? $stdObject->params : null;
    }
}