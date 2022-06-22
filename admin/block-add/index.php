<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/core/include/init.php';

global $App;

$App->properties->setTitle('Block Add | Admin Panel');
$App->properties->addMeta('description', 'Тест описание');

$App->render('/pages/block-add.twig');