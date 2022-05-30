<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/core/include/init.php';

global $App;

$App->properties->setTitle('Block Preview | Admin Panel');
$App->properties->addMeta('description', 'Тест описание');

$App->render('/pages/block-preview.twig');