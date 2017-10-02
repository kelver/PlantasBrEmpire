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
        '/admin/Caracteres-Especiais', function () use ($app) {
            $view = $app->service('view.renderer');
            $auth = $app->service('auth');
            $repositoryCaracteresEspeciais = $app->service('caracteresEspeciais.repository');
            $caracteresEspeciais = $repositoryCaracteresEspeciais->all();

            return $view->render(
                '/admin/Caracteres-Especiais/list.html.twig', [
                    'caracteresEspeciais' => $caracteresEspeciais,
                    'menu' => 'caracteresEspeciais'
                ]
            );
        }, 'admin.caracteresEspeciais.list'
    )
    ->get(
        '/admin/Caracteres-Especiais/', function () use ($app) {
            return $app->route('admin.caracteresEspeciais.list');
        }, 'admin.caracteresEspeciais.redirect'
    )
    ->get(
        '/admin/Caracteres-Especiais/new', function () use ($app) {
            $view = $app->service('view.renderer');
            return $view->render('admin/Caracteres-Especiais/create.html.twig', [
                'menu' => 'caracteresEspeciais'
            ]);
        }, 'admin.caracteresEspeciais.new'
    )
    ->post(
        '/admin/Caracteres-Especiais/store', function (ServerRequestInterface $request) use ($app) {
            $data = $request->getParsedBody();
            $data['status'] = 1;
            $repository = $app->service('caracteresEspeciais.repository');
            $repository->create($data);
            return $app->route('admin.caracteresEspeciais.list');
        }, 'admin.caracteresEspeciais.store'
    )
    ->get(
        '/admin/Caracteres-Especiais/{id}/edit', function (ServerRequestInterface $request) use ($app) {
            $view = $app->service('view.renderer');
            $id = $request->getAttribute('id');
            $repository = $app->service('caracteresEspeciais.repository');
            $caracteresEspeciais = $repository->findOneBy(
                ['id' => $id]
            );
            return $view->render(
                '/admin/Caracteres-Especiais/edit.html.twig', [
                    'caracteresEspeciais' => $caracteresEspeciais,
                    'menu' => 'caracteresEspeciais'
                ]
            );
        }, 'admin.caracteresEspeciais.edit'
    )
    ->post(
        '/admin/Caracteres-Especiais/{id}/update', function (ServerRequestInterface $request) use ($app) {
            $repository = $app->service('caracteresEspeciais.repository');
            $id = $request->getAttribute('id');
            $data = $request->getParsedBody();

            $repository->update($id, $data);
            return $app->route('admin.caracteresEspeciais.list');
        }, 'admin.caracteresEspeciais.update'
    )
    ->get(
        '/admin/Caracteres-Especiais/{id}/status/{status}', function (ServerRequestInterface $request) use ($app) {
            $repository = $app->service('caracteresEspeciais.repository');
            $id = $request->getAttribute('id');
            $data = ['status' => $request->getAttribute('status')];
            $repository->update($id, $data);

            return $app->route('admin.caracteresEspeciais.list');
        }, 'admin.caracteresEspeciais.status'
    );
