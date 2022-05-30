<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/core/include/init.php';

global $App;

$App->properties->setTitle('Blocks | Admin Panel');
$App->properties->addMeta('description', 'Тест описание');

$App->render('/pages/blocks.twig', [
    'ajax' => isset($App->urlParams->ajax)
]);