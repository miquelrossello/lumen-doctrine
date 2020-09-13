<?php
declare(strict_types=1);


namespace App\Application\User;

use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;

class FindUserByUuid
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function find(string $uuid): User
    {
        return $this->userRepository->find($uuid);
    }
}
