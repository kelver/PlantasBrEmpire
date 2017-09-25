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
        '/admin/Origens', function () use ($app) {
            $view = $app->service('view.renderer');
            $auth = $app->service('auth');
            $repositoryOrigem = $app->service('origens.repository');
            $origens = $repositoryOrigem->all();

            return $view->render(
                '/admin/Origens/list.html.twig', [
                    'origens' => $origens,
                    'menu' => 'origens'
                ]
            );
        }, 'admin.origens.list'
    )
    ->get(
        '/admin/Origens/', function () use ($app) {
            return $app->route('admin.origens.list');
        }, 'admin.origens.redirect'
    )
    ->get(
        '/admin/Origens/new', function () use ($app) {
            $view = $app->service('view.renderer');
            return $view->render('admin/Origens/create.html.twig', [
                'menu' => 'origens'
            ]);
        }, 'admin.origens.new'
    )
    ->post(
        '/admin/Origens/store', function (ServerRequestInterface $request) use ($app) {
            $data = $request->getParsedBody();
            $data['status'] = 1;
            $repository = $app->service('origens.repository');
            $repository->create($data);
            return $app->route('admin.origens.list');
        }, 'admin.origens.store'
    )
    ->get(
        '/admin/Origens/{id}/edit', function (ServerRequestInterface $request) use ($app) {
            $view = $app->service('view.renderer');
            $id = $request->getAttribute('id');
            $repository = $app->service('origens.repository');
            $origens = $repository->findOneBy(
                ['id' => $id]
            );
            return $view->render(
                '/admin/Origens/edit.html.twig', [
                    'origens' => $origens,
                    'menu' => 'origens'
                ]
            );
        }, 'admin.origens.edit'
    )
    ->post(
        '/admin/Origens/{id}/update', function (ServerRequestInterface $request) use ($app) {
            $repository = $app->service('origens.repository');
            $id = $request->getAttribute('id');
            $data = $request->getParsedBody();

            $repository->update($id, $data);
            return $app->route('admin.origens.list');
        }, 'admin.origens.update'
    )
    ->get(
        '/admin/Origens/{id}/status/{status}', function (ServerRequestInterface $request) use ($app) {
            $repository = $app->service('origens.repository');
            $id = $request->getAttribute('id');
            $data = ['status' => $request->getAttribute('status')];
            $repository->update($id, $data);

            return $app->route('admin.origens.list');
        }, 'admin.origens.status'
    );

