<?php
declare(strict_types=1);


namespace App\Infrastructure\Controllers\User;


use App\Domain\User\User;
use App\Infrastructure\User\Persistence\Doctrine\DoctrineUserRepository;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class PostUserController extends \App\Infrastructure\Controllers\Controller
{

    public function __invoke()
    {
        $user = new User(
            Uuid::uuid4()->toString(),
            'Miquel',
            'Rosselló Melis'
        );

        $now = Carbon::now();
        $user->setCreatedAt($now);
        $user->setUpdatedAt($now);

        $rep = new DoctrineUserRepository();
        $rep->create($user);
    }

}
