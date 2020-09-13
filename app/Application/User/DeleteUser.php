<?php
declare(strict_types=1);


namespace App\Application\User;


use App\Domain\User\User;
use App\Domain\User\UserRepository;

class DeleteUser
{

    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function execute(string $uuid): void
    {
        $this->userRepository->delete($uuid);
    }

}