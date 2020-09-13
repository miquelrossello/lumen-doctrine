<?php
declare(strict_types=1);


namespace App\Application\User;


use App\Domain\User\User;
use App\Domain\User\UserRepository;
use Carbon\Carbon;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class CreateUser
{

    private UserRepository $userRepository;
    private User $user;

    public function __construct(UserRepository $userRepository, User $user)
    {
        $this->userRepository = $userRepository;
        $this->user = $user;
    }

    public function execute(): void
    {
        try {
            $this->userRepository->create($this->user);
        } catch (UniqueConstraintViolationException $e) {
            throw new UserAlreadyExists();
        }
    }
}
