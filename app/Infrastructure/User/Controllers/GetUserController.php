<?php
declare(strict_types=1);


namespace App\Infrastructure\User\Controllers;


use App\Application\User\FindUserByUuid;
use App\Domain\User\UserNotFoundException;
use App\Infrastructure\User\Persistence\Doctrine\DoctrineUserRepository;
use Illuminate\Support\Facades\Response;
use Laravel\Lumen\Http\Request;

class GetUserController
{

    public function __invoke(Request $request, string $uuid)
    {
        $findUserService = new FindUserByUuid(new DoctrineUserRepository);
        try {
            $user = $findUserService->find($uuid);
            return Response::json($user->toArray(), 200);
        } catch (UserNotFoundException $e) {
            return Response::json(['error' => $e->getMessage()], 202);
        }
    }

}
