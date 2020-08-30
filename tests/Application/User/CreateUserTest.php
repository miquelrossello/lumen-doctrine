<?php
declare(strict_types=1);


namespace Tests\Application\User;


use App\Application\User\CreateUser;
use App\Domain\User\User;
use Tests\Infrastructure\User\Persistence\InMemoryUserRepository;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        // USE MAKE TO BUILD CLASS BUT NOT STORE IT
        $this->user = entity(User::class)->make();
    }

    public function testCreateUserInMemory()
    {
        $inMemoryUserRepository = new InMemoryUserRepository();

        $createUserService = new CreateUser($inMemoryUserRepository, $this->user);
        $createUserService->execute();

        $userExists = false;
        foreach ($inMemoryUserRepository->users as $user) {
            if ($user->getId() === $this->user->getId())
                $userExists = true;
        }

        $this->assertTrue($userExists);
    }

}
