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
        try {
            self::find($user->getId());
            throw new UserAlreadyExists("User already exists");
        } catch (UserNotFoundException $e) {
            array_push($this->users, $user);
        }
    }

    public function find(string $uuid): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getId() === $uuid)
                return $user;
        }

        throw new UserNotFoundException("User couldn't be found.");
    }

    public function delete(string $uuid): void
    {
        $user = self::find($uuid);

        $index = array_search($user, $this->users);
        if ($index === false)
            throw new UserNotFoundException("User couldn't be found.");

        unset($this->users[$index]);
    }
}
