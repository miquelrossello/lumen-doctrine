<?php
declare(strict_types=1);

namespace Tests;

use Laravel\Lumen\Testing\TestCase as BaseTestCase;
use Tests\Infrastructure\Shared\Traits\DoctrineDatabaseMigrations;

abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    protected function setUpTraits()
    {
        parent::setUpTraits();

        // Boot DoctrineDatabaseMigrations trait
        $uses = array_flip(class_uses_recursive(get_class($this)));

        if (isset($uses[DoctrineDatabaseMigrations::class])) {
            $this->runDatabaseMigrations();
        }
    }
}
