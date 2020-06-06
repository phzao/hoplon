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
use Src\Models\LanguageSetting;

use Src\Services\HistoryService;
use Src\Services\ProductService;
use Src\Pages\ProductHTML;

$breadcrumbs = 'Home';

$db = new DatabaseMysql();
$db->openConnection();

$layout = new LayoutHTML();

$languageSetting = new LanguageSetting();
$language = $languageSetting->getPreferredLanguage(strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"]));

$productService = new ProductService($language, $db);

$historyService = new HistoryService($language, $db);
$historyService->setProductService($productService);

$productHTML = new ProductHTML($productService);
$productHTML->setHistoryService($historyService);

$layout->showHeaderHtml($breadcrumbs);
$layout->startContent();

$productHTML->header();
$productHTML->showTheBestSellingProduct();
$productHTML->showProducts();

$layout->endContent();
$layout->showFooterHTML();

$db->closeConnection();