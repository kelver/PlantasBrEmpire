<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 04/06/17
 * Time: 15:59
 */
use Psr\Http\Message\ServerRequestInterface;

$app
    ->get('/admin/Cadastros', function() use ($app){
        $view = $app->service('view.renderer');
        $auth = $app->service('auth');
        $repositoryCadastro = $app->service('user.repository');
        $cadastros = $repositoryCadastro->findByField('tipo', '0');

        return $view->render('/admin/Cadastros/list.html.twig', [
            'cadastros' => $cadastros
        ]);
    }, 'admin.cadastros.list')
    ->get('/admin/Cadastros/', function() use ($app){
        return $app->route('admin.cadastros.list');
    }, 'admin.cadastros.redirect')
    ->get('/admin/Cadastros/{id}/edit', function(ServerRequestInterface $request) use ($app){
        $view = $app->service('view.renderer');
        $auth = $app->service('auth');
        $id = $request->getAttribute('id');
        $repositoryCadastro = $app->service('user.repository');
        $cadastros = $repositoryCadastro->findOneBy(
            ['id' => $id]
        );
        return $view->render('/admin/Cadastros/edit.html.twig', [
            'cadastros' => $cadastros
        ]);
    }, 'admin.cadastros.edit')
    ->post(
        '/admin/Cadastros/{id}/update', function (ServerRequestInterface $request) use ($app) {
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
        return $app->route('admin.cadastros.list');
    }, 'admin.cadastros.update')
    ->get(
        '/admin/Cadastros/{id}/status/{status}', function (ServerRequestInterface $request) use ($app) {
        $auth = $app->service('auth');
        $repositoryCadastro = $app->service('user.repository');
        $idCadastro = $request->getAttribute('id');
        $dataStatus = ['status' => $request->getAttribute('status')];
        $repositoryCadastro->update($idCadastro, $dataStatus);

        return $app->route('admin.cadastros.list');
    }, 'admin.cadastros.status');

