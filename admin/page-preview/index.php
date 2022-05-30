<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/core/include/init.php';

global $App;

$App->properties->setTitle('Page Preview | Admin Panel');
$App->properties->addMeta('description', 'Тест описание');

$App->render('/pages/page-preview.twig');