<?php
session_start();

define('ROOT_PATH', __DIR__);

require ROOT_PATH . '/vendor/autoload.php';
require_once(ROOT_PATH . '/helper/functions.php');
require_once(ROOT_PATH . '/app/Route.php');

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Route;
use App\Controller\FrontController;
use App\Controller\AuthController;

// اتصال دیتابیس
$config = require_once ROOT_PATH . '/config/database.php';
$capsule = new Capsule;
$capsule->addConnection($config);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// تعریف روت‌ها
$route = new Route();

$route->addRoute("GET", "/webfinal", [FrontController::class, 'home']);
$route->addRoute("GET", "/webfinal/posts", [FrontController::class, 'posts']);
$route->addRoute("GET", "/webfinal/matrix", [FrontController::class, 'matrix']);
$route->addRoute("GET", "/webfinal/ranking", [FrontController::class, 'ranking']);
// نمایش فرم ایجاد پست
$route->addRoute("GET", "/webfinal/posts/create", [PostController::class, 'create']);

// ثبت پست جدید (ارسال فرم)
$route->addRoute("POST", "/webfinal/posts/create", [PostController::class, 'store']);


$route->addRoute("GET", "/webfinal/login", [AuthController::class, 'login']);
$route->addRoute("POST", "/webfinal/login", [AuthController::class, 'loginUser']);
$route->addRoute("GET", "/webfinal/register", [AuthController::class, 'register']);
$route->addRoute("POST", "/webfinal/register", [AuthController::class, 'storeUser']);

$route->dispatch();
?>



