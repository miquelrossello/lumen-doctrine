<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;
use LaravelDoctrine\Migrations\Schema\Builder;
use LaravelDoctrine\Migrations\Schema\Table;

class Version20200802113840 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        (new Builder($schema))->create('users', function (Table $table) {
            $table->string('id');

            $table->string('first_name');
            $table->string('last_name')->setNotnull(false)->setDefault("");

            $table->timestamps();
            $table->softDeletes();

            $table->primary('id');
        });
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $schema->dropTable('users');
    }
}
