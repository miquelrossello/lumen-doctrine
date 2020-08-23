<?php
declare(strict_types=1);


namespace App\Application\User;


use App\Domain\User\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class ParseUserFromJsonRequest
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function __invoke(): User
    {
        $data = $this->request->post();
        $this->validateData($data);

        return new User(
            Uuid::uuid4()->toString(),
            $data['firstName'],
            array_key_exists('lastName', $data) !== false ? $data['lastName'] : ''
        );
    }

    /**
     * Validates if the sent data is able to start creating an User
     * @param array $userData Data obtained from request
     * @throws UserDataValidationException
     */
    private function validateData(array $userData): void
    {
        if (
            array_key_exists('firstName', $userData) === false
        )
            throw new UserDataValidationException();
    }

}
