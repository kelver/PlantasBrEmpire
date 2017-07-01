<?php
$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

use PlantasBr\Application;
use PlantasBr\Plugins\AuthPlugin;
use PlantasBr\Plugins\DbPlugin;
use PlantasBr\Plugins\RouterPlugin;
use PlantasBr\Plugins\ViewPlugin;
use PlantasBr\ServiceContainer;
use Psr\Http\Message\ServerRequestInterface;

require_once __DIR__ . '/../vendor/autoload.php';
if(file_exists(__DIR__. '/../.env')) {
    $dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
    $dotenv->overload();
}

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RouterPlugin());
$app->plugin(new ViewPlugin());
$app->plugin(new DbPlugin());
$app->plugin(new AuthPlugin());

require_once (__DIR__ . '/../src/controllers/auth.php');
require_once (__DIR__ . '/../src/controllers/index.php');
require_once (__DIR__ . '/../src/controllers/busca-avancada.php');
require_once (__DIR__ . '/../src/controllers/recrutador.php');
require_once (__DIR__ . '/../src/controllers/sibol.php');
require_once (__DIR__ . '/../src/controllers/glossario.php');
require_once (__DIR__ . '/../src/controllers/referencias.php');
require_once (__DIR__ . '/../src/controllers/contato.php');

// Rotas Administrativas
require_once (__DIR__ . '/../src/controllers/js/admin/auth.php');
require_once (__DIR__ . '/../src/controllers/js/admin/index.php');
require_once (__DIR__ . '/../src/controllers/js/admin/cadastros.php');
require_once (__DIR__ . '/../src/controllers/js/admin/categorias.php');
require_once (__DIR__ . '/../src/controllers/js/admin/continentes.php');
require_once (__DIR__ . '/../src/controllers/js/admin/generos.php');
require_once (__DIR__ . '/../src/controllers/js/admin/origens.php');
require_once (__DIR__ . '/../src/controllers/js/admin/paises.php');
require_once (__DIR__ . '/../src/controllers/js/admin/tipo-folha.php');
require_once (__DIR__ . '/../src/controllers/js/admin/glossarios.php');
require_once (__DIR__ . '/../src/controllers/js/admin/referencias.php');
require_once (__DIR__ . '/../src/controllers/js/admin/especies.php');

//    ->get('/home', function (ServerRequestInterface $request) use ($app){
//        $view = $app->service('view.renderer');
//
//        $model = new Categorias();
//        $categorias = $model->all();
//
//        return $view->render('index.html.twig', [
//            'categorias' => $categorias
//        ]);
//    })
//    ->get('/home/{name}', function (ServerRequestInterface $request) use ($app){
//        $view = $app->service('view.renderer');
//        return $view->render('index.html.twig', ['name' => $request->getAttribute('name')]);
//    })
//    ->get('/inicio/{name}/{id}', function (ServerRequestInterface $request){
//        $response = new Response();
//        $response->getBody()->write("Response com emmiter do diactoros.<br> {$request->getAttribute('id')} - {$request->getAttribute('name')}");
//        return $response;
//    });

$app->start();