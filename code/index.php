<?php
require $_SERVER['DOCUMENT_ROOT'] . "/App/Router.php";
$router = Router::load('routes.php');
$pageName = $router->direct('scrap');
require 'vendor/autoload.php';


use App\Repositories\ShopRepository;
use App\App;
use App\DB\DB;
use App\Router;



$config_path = $_SERVER['DOCUMENT_ROOT'] . "/config.php";
App::bind('config', require $config_path);
$db = new DB(App::get('config')['database']);
$shopRep = new ShopRepository($db->getInstance(App::get('config')['database']));

$path = "https://shafa.ua/women";
if (isset($_GET['action'])){
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if ($action == 'set-page') {
        $path= "https://shafa.ua/women?page=" . $_POST['page'];
    }
}

$pagePath = $_SERVER['DOCUMENT_ROOT'] . $pageName;
include $pagePath;