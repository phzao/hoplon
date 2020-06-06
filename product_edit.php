<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL|E_STRICT);

require 'vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = new DotEnv(__DIR__);
$dotenv->load();

use Src\Models\DatabaseMysql;
use Src\Pages\LayoutHTML;
use Src\Pages\ProductHTML;
use Src\Services\ProductService;

$breadcrumbs = 'Home > Admin';

$db = new DatabaseMysql();
$db->openConnection();

$language = 'PT';

$productService = new ProductService($language, $db);

$layout = new LayoutHTML();

$productHTML = new ProductHTML($productService);

$layout->showHeaderHtml($breadcrumbs);
$layout->startContent();

//$productHTML->

$layout->endContent();
$layout->showFooterHTML();

$db->closeConnection();