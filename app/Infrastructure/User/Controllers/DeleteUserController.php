<?php
declare(strict_types=1);


namespace App\Infrastructure\User\Controllers;


use App\Application\User\DeleteUser;
use App\Infrastructure\User\Persistence\Doctrine\DoctrineUserRepository;
use App\Infrastructure\User\Persistence\Doctrine\UserNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DeleteUserController
{

    public function __invoke(Request $request, string $uuid)
    {
        $deleteUserService = new DeleteUser(new DoctrineUserRepository());

        try {
            $deleteUserService->execute($uuid);
            return Response::json(['success' => 'User' . $uuid . ' has been deleted.'], 200);
        } catch (UserNotFoundException $e) {
            return Response::json(['error' => $e->getMessage()], 200);
        }
    }

}
