<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 04/06/17
 * Time: 15:59
 */
use Psr\Http\Message\ServerRequestInterface;

$app
    ->get(
        '/admin/Tipo-Folha', function () use ($app) {
            $view = $app->service('view.renderer');
            $auth = $app->service('auth');
            $repositoryTipoFolha = $app->service('tipoFolha.repository');
            $tipoFolha = $repositoryTipoFolha->all();

            return $view->render(
                '/admin/TipoFolha/list.html.twig', [
                    'tipoFolha' => $tipoFolha,
                    'menu' => 'tipoFolha'
                ]
            );
        }, 'admin.tipoFolha.list'
    )
    ->get(
        '/admin/Tipo-Folha/', function () use ($app) {
            return $app->route('admin.tipoFolha.list');
        }, 'admin.tipoFolha.redirect'
    )
    ->get(
        '/admin/Tipo-Folha/new', function () use ($app) {
            $view = $app->service('view.renderer');
            return $view->render('admin/TipoFolha/create.html.twig', [
                'menu' => 'tipoFolha'
            ]);
        }, 'admin.tipoFolha.new'
    )
    ->post(
        '/admin/Tipo-Folha/store', function (ServerRequestInterface $request) use ($app) {
            $data = $request->getParsedBody();
            $data['status'] = 1;
            $repository = $app->service('tipoFolha.repository');
            $repository->create($data);
            return $app->route('admin.tipoFolha.list');
        }, 'admin.tipoFolha.store'
    )
    ->get(
        '/admin/Tipo-Folha/{id}/edit', function (ServerRequestInterface $request) use ($app) {
            $view = $app->service('view.renderer');
            $id = $request->getAttribute('id');
            $repository = $app->service('tipoFolha.repository');
            $tipoFolha = $repository->findOneBy(
                ['id' => $id]
            );
            return $view->render(
                '/admin/TipoFolha/edit.html.twig', [
                    'tipoFolha' => $tipoFolha,
                    'menu' => 'tipoFolha'
                ]
            );
        }, 'admin.tipoFolha.edit'
    )
    ->post(
        '/admin/Tipo-Folha/{id}/update', function (ServerRequestInterface $request) use ($app) {
            $repository = $app->service('tipoFolha.repository');
            $id = $request->getAttribute('id');
            $data = $request->getParsedBody();

            $repository->update($id, $data);
            return $app->route('admin.tipoFolha.list');
        }, 'admin.tipoFolha.update'
    )
    ->get(
        '/admin/Tipo-Folha/{id}/status/{status}', function (ServerRequestInterface $request) use ($app) {
            $repository = $app->service('tipoFolha.repository');
            $id = $request->getAttribute('id');
            $data = ['status' => $request->getAttribute('status')];
            $repository->update($id, $data);

            return $app->route('admin.tipoFolha.list');
        }, 'admin.tipoFolha.status'
    );

