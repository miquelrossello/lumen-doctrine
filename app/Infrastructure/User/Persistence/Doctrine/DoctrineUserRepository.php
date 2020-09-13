<?php
declare(strict_types=1);


namespace App\Infrastructure\User\Persistence\Doctrine;


use App\Domain\User\User;
use App\Domain\User\UserRepository;
use LaravelDoctrine\ORM\Facades\EntityManager;

class DoctrineUserRepository implements UserRepository
{

    public function create(User $user): void
    {
       try {
           // If user is found throw UserAlreadyExists exception.
           self::find($user->getId());
           throw new UserAlreadyExists("This User already exists.");
       } catch (UserNotFoundException $e) {
           // If UserNotFoundException is thrown we can proceed
           // creating new User.
           EntityManager::persist($user);
           EntityManager::flush();
       }
    }

    public function find(string $uuid): User
    {
        $user = EntityManager::getRepository(User::class)->find($uuid);

        if (!$user)
            throw new UserNotFoundException("User couldn't be found.");

        return $user;
    }

    public function delete(string $uuid): void
    {
        // Try to search user. If doesn't throws UserNotFoundException
        // is because User exists and can proceed to remove.
        $user = self::find($uuid);

        EntityManager::remove($user);
        EntityManager::flush();
    }
}
