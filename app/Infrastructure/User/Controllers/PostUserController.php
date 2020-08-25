<?php
declare(strict_types=1);


namespace App\Infrastructure\User\Controllers;


use App\Application\User\CreateUser;
use App\Application\User\CreateUserRequestValidation;
use App\Application\User\ParseUserFromJsonRequest;
use App\Application\User\UserDataValidationException;
use App\Domain\User\User;
use App\Domain\User\UserAlreadyExists;
use App\Infrastructure\User\Persistence\Doctrine\DoctrineUserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;

class PostUserController
{

    public function __invoke(Request $request)
    {

        try {
            $requestParser = new ParseUserFromJsonRequest($request);
            $user = $requestParser();

            $createUserService = new CreateUser(new DoctrineUserRepository(), $user);
            $createUserService->execute();
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
