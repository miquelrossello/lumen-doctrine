<?php
declare(strict_types=1);


namespace App\Infrastructure\User\Controllers;


use App\Application\User\CreateUser;
use App\Application\User\ParseUserFromJsonRequest;
use App\Application\User\UserDataValidationException;
use App\Infrastructure\User\Persistence\Doctrine\DoctrineUserRepository;
use App\Infrastructure\User\Persistence\Doctrine\UserAlreadyExists;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostUserController
{

    public function __invoke(Request $request)
    {

        try {
            $requestParser = new ParseUserFromJsonRequest($request);
            $user = $requestParser();

            $createUserService = new CreateUser(new DoctrineUserRepository());
            $createUserService->execute($user);
            return new Response([
                'success' => 'User created'
            ], 202);
        } catch (UserDataValidationException $e) {
            return new Response([
                'error' => $e->getMessage()
            ]);
        } catch (UserAlreadyExists $e) {
            return new Response([
                'error' => 'User already exists'
            ], 200);
        }
    }

}
