<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 04/06/17
 * Time: 15:59
 */
use Psr\Http\Message\ServerRequestInterface;

$app
    ->get('/admin/Generos', function() use ($app){
        $view = $app->service('view.renderer');
        $auth = $app->service('auth');
        $repositoryGenero = $app->service('generos.repository');
        $generos = $repositoryGenero->all();

        return $view->render('/admin/Generos/list.html.twig', [
            'generos' => $generos
        ]);
    }, 'admin.generos.list')
    ->get('/admin/Generos/', function() use ($app){
        return $app->route('admin.generos.list');
    }, 'admin.generos.redirect')
    ->get(
        '/admin/Generos/new', function () use ($app) {
            $view = $app->service('view.renderer');
            return $view->render('admin/Generos/create.html.twig');
        }, 'admin.generos.new'
    )
    ->post(
        '/admin/Generos/store', function (ServerRequestInterface $request) use ($app) {
            $data = $request->getParsedBody();
            $data['status'] = 1;
            $repository = $app->service('generos.repository');
            $repository->create($data);
            return $app->route('admin.generos.list');
        }, 'admin.generos.store'
    )
    ->get('/admin/Generos/{id}/edit', function(ServerRequestInterface $request) use ($app){
        $view = $app->service('view.renderer');
        $id = $request->getAttribute('id');
        $repository = $app->service('generos.repository');
        $generos = $repository->findOneBy(
            ['id' => $id]
        );
        return $view->render('/admin/Generos/edit.html.twig', [
            'generos' => $generos
        ]);
    }, 'admin.generos.edit')
    ->post(
        '/admin/Generos/{id}/update', function (ServerRequestInterface $request) use ($app) {
        $repository = $app->service('generos.repository');
        $id = $request->getAttribute('id');
        $data = $request->getParsedBody();

        $repository->update($id, $data);
        return $app->route('admin.generos.list');
    }, 'admin.generos.update')
    ->get(
        '/admin/Generos/{id}/status/{status}', function (ServerRequestInterface $request) use ($app) {
        $repository = $app->service('generos.repository');
        $id = $request->getAttribute('id');
        $data = ['status' => $request->getAttribute('status')];
        $repository->update($id, $data);

        return $app->route('admin.generos.list');
    }, 'admin.generos.status');

