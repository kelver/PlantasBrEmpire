<?php
use Psr\Http\Message\ServerRequestInterface;

$app
    ->get(
        '/login', function () use ($app) {
            $view = $app->service('view.renderer');
            $auth = $app->service('auth');
            if($auth->check() && $auth->is('user')) {
                return $app->route('index');
            }

            return $view->render('login.html.twig');
        }, 'auth.show_login_form'
    )
    ->post(
        '/login', function (ServerRequestInterface $request) use ($app) {
            $view = $app->service('view.renderer');
            $auth = $app->service('auth');
            $data = $request->getParsedBody();
            $result = $auth->login($data);

            if(!$result) {
                return $view->render('login.html.twig');
            }
            if(!$auth->is('user')) {
                return $app->route('auth.logout');
            }
            return $app->route('index');
        }, 'auth.login'
    )
    ->get(
        '/logout', function () use ($app) {
            $app->service('auth')->logout();
            return $app->route('auth.show_login_form');
        }, 'auth.logout'
    );

$app->before(
    function (ServerRequestInterface $request) use ($app) {
        $route = $app->service('route');
        $auth = $app->service('auth');
        $routesBlackList = [

        ];

        $routesWhiteListAdmin = [
            'admin.auth.show_login_form',
            'admin.auth.login',
            'admin.auth.logout'
        ];
        $rotaLocal = explode('.', $route->name);
        if($rotaLocal[0] != 'admin') {
            if (in_array($route->name, $routesBlackList) && (!$auth->check() || !$auth->is('user'))) {
                return $app->route('auth.show_login_form');
            }
        }else{
            if (!in_array($route->name, $routesWhiteListAdmin) && (!$auth->check() || !$auth->is('admin'))) {
                return $app->route('admin.auth.show_login_form');
            }
        }
    }
);