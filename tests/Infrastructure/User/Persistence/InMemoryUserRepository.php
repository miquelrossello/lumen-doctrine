<?php
declare(strict_types=1);


namespace Tests\Infrastructure\User\Persistence;


use App\Domain\User\User;
use App\Domain\User\UserRepository;
use App\Infrastructure\User\Persistence\Doctrine\UserAlreadyExists;
use App\Infrastructure\User\Persistence\Doctrine\UserNotFoundException;

class InMemoryUserRepository implements UserRepository
{

    public array $users = array();

    public function create(User $user): void
    {
        array_push($this->users, $user);
    }

    public function find(string $uuid): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getId() === $uuid)
                return $user;
        }

        return null;
    }
}
