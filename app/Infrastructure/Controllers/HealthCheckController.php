<?php
declare(strict_types=1);
namespace App\Infrastructure\Controllers;


use Illuminate\Http\Response;

class HealthCheckController extends \Laravel\Lumen\Routing\Controller
{

    public function __invoke()
    {
        return new Response([
            'health-check' => 'static-ok'
        ]);
    }

}
