<?php
use Psr\Http\Message\ServerRequestInterface;

$app
    ->get('/login', function () use ($app){
        $view = $app->service('view.renderer');
        return $view->render('login.html.twig');
    }, 'auth.show_login_form')
    ->post('/login', function (ServerRequestInterface $request) use ($app){
        $view = $app->service('view.renderer');
        $auth = $app->service('auth');
        $data = $request->getParsedBody();

        $result = $auth->login($data);
        if(!$result){
            return $view->render('login.html.twig');
        }
        return $app->route('index');
    }, 'auth.login')
    ->get('/logout', function () use ($app){
        $app->service('auth')->logout();
        return $app->route('auth.show_login_form');
    }, 'auth.logout');