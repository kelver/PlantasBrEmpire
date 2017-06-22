<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 04/06/17
 * Time: 15:59
 */
use Psr\Http\Message\ServerRequestInterface;

$app
    ->get('/admin/Categorias', function() use ($app){
        $view = $app->service('view.renderer');
        $auth = $app->service('auth');
        $repositoryCategoria = $app->service('categorias.repository');
        $categorias = $repositoryCategoria->all();

        return $view->render('/admin/Categorias/list.html.twig', [
            'categorias' => $categorias
        ]);
    }, 'admin.categorias.list')
    ->get('/admin/Categorias/', function() use ($app){
        return $app->route('admin.categorias.list');
    }, 'admin.categorias.redirect')
    ->get(
        '/admin/Categorias/new', function () use ($app) {
            $view = $app->service('view.renderer');
            return $view->render('admin/Categorias/create.html.twig');
        }, 'admin.categorias.new'
    )
    ->post(
        '/admin/Categorias/store', function (ServerRequestInterface $request) use ($app) {
            $data = $request->getParsedBody();
            $data['status'] = 1;
            $repository = $app->service('categorias.repository');
            $repository->create($data);
            return $app->route('admin.categorias.list');
        }, 'admin.categorias.store'
    )
    ->get('/admin/Categorias/{id}/edit', function(ServerRequestInterface $request) use ($app){
        $view = $app->service('view.renderer');
        $id = $request->getAttribute('id');
        $repository = $app->service('categorias.repository');
        $categorias = $repository->findOneBy(
            ['id' => $id]
        );
        return $view->render('/admin/Categorias/edit.html.twig', [
            'categorias' => $categorias
        ]);
    }, 'admin.categorias.edit')
    ->post(
        '/admin/Categorias/{id}/update', function (ServerRequestInterface $request) use ($app) {
        $repository = $app->service('categorias.repository');
        $id = $request->getAttribute('id');
        $data = $request->getParsedBody();

        $repository->update($id, $data);
        return $app->route('admin.categorias.list');
    }, 'admin.categorias.update')
    ->get(
        '/admin/Categorias/{id}/status/{status}', function (ServerRequestInterface $request) use ($app) {
        $repository = $app->service('categorias.repository');
        $id = $request->getAttribute('id');
        $data = ['status' => $request->getAttribute('status')];
        $repository->update($id, $data);

        return $app->route('admin.categorias.list');
    }, 'admin.categorias.status');

