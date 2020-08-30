<?php
declare(strict_types=1);


namespace Tests\Application\User;


use App\Application\User\FindUserByUuid;
use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use Tests\Infrastructure\User\Persistence\InMemoryUserRepository;
use Tests\TestCase;

class FindUserTestByUuidTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = entity(User::class)->make();
    }

    public function testFindUserByUuid()
    {
        $repository = new InMemoryUserRepository();
        // Fake that User is existing
        $repository->create($this->user);

        $findUserByUuidService = new FindUserByUuid($repository);
        $this->assertNotEmpty($findUserByUuidService->find($this->user->getId()));
    }

    public function testUserNotFoundByUuidThrowsException()
    {
        // Create empty repository which will cause User not found
        $repository = new InMemoryUserRepository();

        $findUserByUuidService = new FindUserByUuid($repository);

        $this->expectException(UserNotFoundException::class);
        $findUserByUuidService->find($this->user->getId());
    }
}
