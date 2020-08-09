<?php
declare(strict_types=1);

$router->get('users/{uuid}', 'User\Controllers\GetUserController');
