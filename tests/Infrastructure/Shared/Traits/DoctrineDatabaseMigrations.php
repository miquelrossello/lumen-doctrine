<?php
declare(strict_types=1);


namespace Tests\Infrastructure\Shared\Traits;


trait DoctrineDatabaseMigrations
{

    /**
     * Runs migrations on Doctrine project
     */
    public function runDatabaseMigrations(): void
    {
        $this->artisan('doctrine:migrations:migrate');

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('doctrine:migrations:rollback');
        });
    }

}
