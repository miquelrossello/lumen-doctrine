<?php
declare(strict_types=1);


namespace App\Infrastructure\User\Controllers;


use Laravel\Lumen\Http\Request;

class GetUserController
{

    public function __invoke(Request $request, string $uuid)
    {
        return $uuid;
    }

}
