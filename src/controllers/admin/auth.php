<?php
use Psr\Http\Message\ServerRequestInterface;

$app
    ->get('/admin/login', function () use ($app){
        $view = $app->service('view.renderer');
        return $view->render('admin/login.html.twig');
    }, 'admin.auth.show_login_form')
    ->post('/admin/login', function (ServerRequestInterface $request) use ($app){
        $view = $app->service('view.renderer');
        $auth = $app->service('auth.admin');
        $data = $request->getParsedBody();

        $result = $auth->login($data);
        if(!$result){
            return $view->render('admin/login.html.twig');
        }
        return $app->route('admin.index');
    }, 'admin.auth.login')
    ->get('/admin/logout', function () use ($app){
        $app->service('auth.admin')->logout();
        return $app->route('admin.auth.show_login_form');
    }, 'admin.auth.logout');