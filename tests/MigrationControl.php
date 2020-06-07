<?php

namespace Src\Tests;

use Src\Migrations\MigrationTestDB;

trait MigrationControl
{
    public function executeMigrations()
    {
        $this->migrations = new MigrationTestDB($this->database);

        $this->migrations->migration20200001();
        $this->migrations->migration20200002();
        $this->migrations->migration20200003();
    }
}