<?php
declare(strict_types=1);


namespace Tests\Application\User;


use App\Application\User\DeleteUser;
use App\Domain\User\User;
use App\Infrastructure\User\Persistence\Doctrine\UserNotFoundException;
use Tests\Infrastructure\User\Persistence\InMemoryUserRepository;

class DeleteUserTest extends \Tests\TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = entity(User::class)->make();
    }

    public function testDeleteUserInMemory()
    {
        $inMemoryUserRepository = new InMemoryUserRepository();
        $inMemoryUserRepository->create($this->user);

        $deleteUserService = new DeleteUser($inMemoryUserRepository);
        $deleteUserService->execute($this->user->getId());

        $this->expectException(UserNotFoundException::class);
        $inMemoryUserRepository->find($this->user->getId());
    }

}
