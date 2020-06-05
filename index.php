<?php
require 'vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = new DotEnv(__DIR__);
$dotenv->load();

use Src\Models\DatabaseMysql;
use Src\Pages\LayoutHTML;
use Src\Models\LanguageSetting;

$breadcrumbs = 'Home';
$db = new DatabaseMysql();
$layout = new LayoutHTML();

$languageSetting = new LanguageSetting();
$language = $languageSetting->getPreferredLanguage(strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"]));

$layout->showHeaderHtml();

$layout->showFooterHTML();
