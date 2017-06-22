<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 04/06/17
 * Time: 15:59
 */
use Psr\Http\Message\ServerRequestInterface;

$app
    ->get('/admin/Glossarios', function() use ($app){
        $view = $app->service('view.renderer');
        $auth = $app->service('auth');
        $repositoryGlossario = $app->service('glossarios.repository');
        $glossarios = $repositoryGlossario->all();

        return $view->render('/admin/Glossarios/list.html.twig', [
            'glossarios' => $glossarios
        ]);
    }, 'admin.glossarios.list')
    ->get('/admin/Glossarios/', function() use ($app){
        return $app->route('admin.glossarios.list');
    }, 'admin.glossarios.redirect')
    ->get(
        '/admin/Glossarios/new', function () use ($app) {
            $view = $app->service('view.renderer');
            return $view->render('admin/Glossarios/create.html.twig');
        }, 'admin.glossarios.new'
    )
    ->post(
        '/admin/Glossarios/store', function (ServerRequestInterface $request) use ($app) {
            $data = $request->getParsedBody();
            $data['status'] = 1;
            $repository = $app->service('glossarios.repository');
            $repository->create($data);
            return $app->route('admin.glossarios.list');
        }, 'admin.glossarios.store'
    )
    ->get('/admin/Glossarios/{id}/edit', function(ServerRequestInterface $request) use ($app){
        $view = $app->service('view.renderer');
        $id = $request->getAttribute('id');
        $repository = $app->service('glossarios.repository');
        $glossarios = $repository->findOneBy(
            ['id' => $id]
        );
        return $view->render('/admin/Glossarios/edit.html.twig', [
            'glossarios' => $glossarios
        ]);
    }, 'admin.glossarios.edit')
    ->post(
        '/admin/Glossarios/{id}/update', function (ServerRequestInterface $request) use ($app) {
        $repository = $app->service('glossarios.repository');
        $id = $request->getAttribute('id');
        $data = $request->getParsedBody();

        $repository->update($id, $data);
        return $app->route('admin.glossarios.list');
    }, 'admin.glossarios.update')
    ->get(
        '/admin/Glossarios/{id}/status/{status}', function (ServerRequestInterface $request) use ($app) {
        $repository = $app->service('glossarios.repository');
        $id = $request->getAttribute('id');
        $data = ['status' => $request->getAttribute('status')];
        $repository->update($id, $data);

        return $app->route('admin.glossarios.list');
    }, 'admin.glossarios.status');
