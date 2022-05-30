<?php

require_once 'constants.php';
require_once ADMIN_PATH . '/core/vendor/autoload.php';

spl_autoload_register(function ($className) {
    $fileName = lcfirst($className) . '.php';
    include ADMIN_PATH . '/core/lib/' . $fileName;
});

$App = new Engine();