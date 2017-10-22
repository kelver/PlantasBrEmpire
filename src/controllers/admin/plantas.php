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
        '/admin/Plantas', function () use ($app) {
            $view = $app->service('view.renderer');
            $auth = $app->service('auth');
            $repositoryCadastro = $app->service('user.repository');
            $plantas = $repositoryCadastro->findByField('tipo', '0');

            return $view->render(
                '/admin/Plantas/list.html.twig', [
                    'plantas' => $plantas,
                    'menu' => 'plantas'
                ]
            );
        }, 'admin.plantas.list'
    )
    ->get(
        '/admin/Plantas/', function () use ($app) {
            return $app->route('admin.plantas.list');
        }, 'admin.plantas.redirect'
    )
    ->get(
        '/admin/Plantas/new', function () use ($app) {
            $view = $app->service('view.renderer');
            $auth = $app->service('auth');
            $repository= $app->service('plantas.repository');

            return $view->render(
                '/admin/Plantas/create.html.twig', [
                    'menu' => 'plantas'
                ]
            );
        }, 'admin.plantas.new'
    )
    ->post(
        '/admin/Plantas/store', function (ServerRequestInterface $request) use ($app) {
        $data = $request->getParsedBody();
        $data['status'] = 1;
        print_r("<pre>");
        print_r($data);
        die('sdasdas');
        $repository = $app->service('plantas.repository');
        $repository->create($data);
        return $app->route('admin.plantas.list');
    }, 'admin.plantas.store'
    )
    ->get(
        '/admin/Plantas/{id}/edit', function (ServerRequestInterface $request) use ($app) {
            $view = $app->service('view.renderer');
            $auth = $app->service('auth');
            $id = $request->getAttribute('id');
            $repositoryCadastro = $app->service('user.repository');
            $plantas = $repositoryCadastro->findOneBy(
                ['id' => $id]
            );
            return $view->render(
                '/admin/Plantas/edit.html.twig', [
                    'plantas' => $plantas,
                    'menu' => 'plantas'
                ]
            );
        }, 'admin.plantas.edit'
    )
    ->post(
        '/admin/Plantas/{id}/update', function (ServerRequestInterface $request) use ($app) {
            $auth = $app->service('auth');
            $repositoryPessoa = $app->service('pessoa.repository');
            $repositoryCadastro = $app->service('user.repository');
            $idCadastro = $request->getAttribute('id');
            $idPessoa = $repositoryCadastro->find($idCadastro)['attributes']['pessoa_id'];
            $data = $request->getParsedBody();
            $dataPessoa = ['nome' => $data['nome'], 'email' => $data['email'], 'telefone' => $data['telefone']];
            $dataCadastro = ['usuario' => $data['usuario']];
            $data['senha'] != '' ? $dataCadastro = ['senha' => $auth->hashPassword($data['senha'])] : '';

            $repositoryCadastro->update($idCadastro, $dataCadastro);

            $repositoryPessoa->update($idPessoa, $dataPessoa);
            return $app->route('admin.plantas.list');
        }, 'admin.plantas.update'
    )
    ->get(
        '/admin/Plantas/{id}/status/{status}', function (ServerRequestInterface $request) use ($app) {
            $auth = $app->service('auth');
            $repositoryCadastro = $app->service('user.repository');
            $idCadastro = $request->getAttribute('id');
            $dataStatus = ['status' => $request->getAttribute('status')];
            $repositoryCadastro->update($idCadastro, $dataStatus);

            return $app->route('admin.plantas.list');
        }, 'admin.plantas.status'
    );

