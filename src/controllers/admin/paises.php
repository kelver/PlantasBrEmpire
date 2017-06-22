<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 04/06/17
 * Time: 15:59
 */
use Psr\Http\Message\ServerRequestInterface;

$app
    ->get('/admin/Paises', function() use ($app){
        $view = $app->service('view.renderer');
        $auth = $app->service('auth');
        $repositoryPais = $app->service('paises.repository');
        $paises = $repositoryPais->all();

        return $view->render('/admin/Paises/list.html.twig', [
            'paises' => $paises
        ]);
    }, 'admin.paises.list')
    ->get('/admin/Paises/', function() use ($app){
        return $app->route('admin.paises.list');
    }, 'admin.paises.redirect')
    ->get(
        '/admin/Paises/new', function () use ($app) {
            $view = $app->service('view.renderer');
            return $view->render('admin/Paises/create.html.twig');
        }, 'admin.paises.new'
    )
    ->post(
        '/admin/Paises/store', function (ServerRequestInterface $request) use ($app) {
            $data = $request->getParsedBody();
            $data['status'] = 1;
            $repository = $app->service('paises.repository');
            $repository->create($data);
            return $app->route('admin.paises.list');
        }, 'admin.paises.store'
    )
    ->get('/admin/Paises/{id}/edit', function(ServerRequestInterface $request) use ($app){
        $view = $app->service('view.renderer');
        $id = $request->getAttribute('id');
        $repository = $app->service('paises.repository');
        $paises = $repository->findOneBy(
            ['id' => $id]
        );
        return $view->render('/admin/Paises/edit.html.twig', [
            'paises' => $paises
        ]);
    }, 'admin.paises.edit')
    ->post(
        '/admin/Paises/{id}/update', function (ServerRequestInterface $request) use ($app) {
        $repository = $app->service('paises.repository');
        $id = $request->getAttribute('id');
        $data = $request->getParsedBody();

        $repository->update($id, $data);
        return $app->route('admin.paises.list');
    }, 'admin.paises.update')
    ->get(
        '/admin/Paises/{id}/status/{status}', function (ServerRequestInterface $request) use ($app) {
        $repository = $app->service('paises.repository');
        $id = $request->getAttribute('id');
        $data = ['status' => $request->getAttribute('status')];
        $repository->update($id, $data);

        return $app->route('admin.paises.list');
    }, 'admin.paises.status');

