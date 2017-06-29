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
        '/admin/Referencias', function () use ($app) {
            $view = $app->service('view.renderer');
            $auth = $app->service('auth');
            $repositoryReferencia = $app->service('referencias.repository');
            $referencias = $repositoryReferencia->all();

            return $view->render(
                '/admin/Referencias/list.html.twig', [
                'referencias' => $referencias
                ]
            );
        }, 'admin.referencias.list'
    )
    ->get(
        '/admin/Referencias/', function () use ($app) {
            return $app->route('admin.referencias.list');
        }, 'admin.referencias.redirect'
    )
    ->get(
        '/admin/Referencias/new', function () use ($app) {
            $view = $app->service('view.renderer');
            return $view->render('admin/Referencias/create.html.twig');
        }, 'admin.referencias.new'
    )
    ->post(
        '/admin/Referencias/store', function (ServerRequestInterface $request) use ($app) {
            $data = $request->getParsedBody();
            $data['status'] = 1;
            $repository = $app->service('referencias.repository');
            $repository->create($data);
            return $app->route('admin.referencias.list');
        }, 'admin.referencias.store'
    )
    ->get(
        '/admin/Referencias/{id}/edit', function (ServerRequestInterface $request) use ($app) {
            $view = $app->service('view.renderer');
            $id = $request->getAttribute('id');
            $repository = $app->service('referencias.repository');
            $referencias = $repository->findOneBy(
                ['id' => $id]
            );
            return $view->render(
                '/admin/Referencias/edit.html.twig', [
                'referencias' => $referencias
                ]
            );
        }, 'admin.referencias.edit'
    )
    ->post(
        '/admin/Referencias/{id}/update', function (ServerRequestInterface $request) use ($app) {
            $repository = $app->service('referencias.repository');
            $id = $request->getAttribute('id');
            $data = $request->getParsedBody();

            $repository->update($id, $data);
            return $app->route('admin.referencias.list');
        }, 'admin.referencias.update'
    )
    ->get(
        '/admin/Referencias/{id}/status/{status}', function (ServerRequestInterface $request) use ($app) {
            $repository = $app->service('referencias.repository');
            $id = $request->getAttribute('id');
            $data = ['status' => $request->getAttribute('status')];
            $repository->update($id, $data);

            return $app->route('admin.referencias.list');
        }, 'admin.referencias.status'
    );

