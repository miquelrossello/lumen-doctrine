<?php
declare(strict_types=1);

$router->get('users/{uuid}', 'User\Controllers\GetUserController');
$router->post('users', 'User\Controllers\PostUserController');
$router->delete('users/{uuid}', 'User\Controllers\DeleteUserController');
