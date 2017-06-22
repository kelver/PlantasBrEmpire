<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 04/06/17
 * Time: 15:59
 */
use Psr\Http\Message\ServerRequestInterface;

$app
    ->get('/admin/Continentes', function() use ($app){
        $view = $app->service('view.renderer');
        $auth = $app->service('auth');
        $repositoryContinente = $app->service('continentes.repository');
        $continentes = $repositoryContinente->all();

        return $view->render('/admin/Continentes/list.html.twig', [
            'continentes' => $continentes
        ]);
    }, 'admin.continentes.list')
    ->get('/admin/Continentes/', function() use ($app){
        return $app->route('admin.continentes.list');
    }, 'admin.continentes.redirect')
    ->get(
        '/admin/Continentes/new', function () use ($app) {
            $view = $app->service('view.renderer');
            return $view->render('admin/Continentes/create.html.twig');
        }, 'admin.continentes.new'
    )
    ->post(
        '/admin/Continentes/store', function (ServerRequestInterface $request) use ($app) {
            $data = $request->getParsedBody();
            $data['status'] = 1;
            $repository = $app->service('continentes.repository');
            $repository->create($data);
            return $app->route('admin.continentes.list');
        }, 'admin.continentes.store'
    )
    ->get('/admin/Continentes/{id}/edit', function(ServerRequestInterface $request) use ($app){
        $view = $app->service('view.renderer');
        $id = $request->getAttribute('id');
        $repository = $app->service('continentes.repository');
        $continentes = $repository->findOneBy(
            ['id' => $id]
        );
        return $view->render('/admin/Continentes/edit.html.twig', [
            'continentes' => $continentes
        ]);
    }, 'admin.continentes.edit')
    ->post(
        '/admin/Continentes/{id}/update', function (ServerRequestInterface $request) use ($app) {
        $repository = $app->service('continentes.repository');
        $id = $request->getAttribute('id');
        $data = $request->getParsedBody();

        $repository->update($id, $data);
        return $app->route('admin.continentes.list');
    }, 'admin.continentes.update')
    ->get(
        '/admin/Continentes/{id}/status/{status}', function (ServerRequestInterface $request) use ($app) {
        $repository = $app->service('continentes.repository');
        $id = $request->getAttribute('id');
        $data = ['status' => $request->getAttribute('status')];
        $repository->update($id, $data);

        return $app->route('admin.continentes.list');
    }, 'admin.continentes.status');

