<?php
declare(strict_types=1);


namespace App\Infrastructure\User\Persistence\Doctrine;


use App\Domain\User\User;
use App\Domain\User\UserRepository;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Doctrine\Persistence\ObjectRepository;

class DoctrineUserRepository implements UserRepository
{

    public function create(User $user): void
    {
        EntityManager::persist($user);
        EntityManager::flush();
    }
}
