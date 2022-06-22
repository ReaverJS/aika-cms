<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/core/include/init.php';

global $App;

$App->site->generate();
?>

<h1>Сайт сгенерирован</h1>
<h2><a href="/">Просмотреть</a></h2>
<h2><a href="/admin">Вернуться в админ панель</a></h2>
