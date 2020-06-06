<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL|E_STRICT);

require 'vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = new DotEnv(__DIR__);
$dotenv->load();

use Src\Models\DatabaseMysql;
use Src\Migrations\AddNewLanguage;

$db = new DatabaseMysql();
$db->openConnection();

$migration = new AddNewLanguage($db);
$migration->runMigration();
$db->closeConnection();