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
        '/admin/Cadastros', function () use ($app) {
            $view = $app->service('view.renderer');
            $auth = $app->service('auth');
            $repositoryCadastro = $app->service('user.repository');
//            $cadastros = $repositoryCadastro->findByField('tipo', '0');
            $cadastros = \PlantasBr\Models\Cadastros::with('pessoa')->where('tipo', '=', '0')->get();

            return $view->render(
                '/admin/Cadastros/list.html.twig', [
                    'cadastros' => $cadastros,
                    'menu' => 'cadastros'
                ]
            );
        }, 'admin.cadastros.list'
    )
    ->get(
        '/admin/Cadastros/', function () use ($app) {
            return $app->route('admin.cadastros.list');
        }, 'admin.cadastros.redirect'
    )
    ->get(
        '/admin/Cadastros/new', function () use ($app) {
            $view = $app->service('view.renderer');
            return $view->render('admin/Cadastros/create.html.twig', [
                'menu' => 'cadastros'
            ]);
        }, 'admin.cadastros.new'
    )
    ->post(
        '/admin/Cadastros/store', function (ServerRequestInterface $request) use ($app) {
        $auth = $app->service('auth');
        $data = $request->getParsedBody();
        $data['senha'] = $auth->hashPassword($data['senha']);
        $data['usuario'] = $data['email'];
        $data['dataAssinatura'] = $data['dataAssinatura_submit'];

        print_r($data);
        $repositoryUsuario = $app->service('user.repository');
        $repositoryPessoa = $app->service('pessoa.repository');
        $Pessoa = $repositoryPessoa->create($data);
        $data['idPessoa'] = $Pessoa->id;
        $repositoryUsuario->create($data);
        return $app->route('admin.cadastros.list');
    }, 'admin.cadastros.store'
    )
    ->get(
        '/admin/Cadastros/{id}/edit', function (ServerRequestInterface $request) use ($app) {
            $view = $app->service('view.renderer');
            $auth = $app->service('auth');
            $id = $request->getAttribute('id');
            $repositoryCadastro = $app->service('user.repository');
            $cadastros = $repositoryCadastro->findOneBy(
                ['id' => $id]
            );
            $repositoryPessoa = $app->service('pessoa.repository');
            $pessoa = $repositoryPessoa->findOneBy(
                ['id' => $cadastros['idPessoa']]
            );
//            print_r('<pre>');
//            print_r($cadastros);
//            print_r($pessoa);

            return $view->render(
                '/admin/Cadastros/edit.html.twig', [
                    'usuario' => $cadastros,
                    'pessoa' => $pessoa,
                    'menu' => 'cadastros'
                ]
            );
        }, 'admin.cadastros.edit'
    )
    ->post(
        '/admin/Cadastros/{id}/update', function (ServerRequestInterface $request) use ($app) {
            $auth = $app->service('auth');
            $repositoryPessoa = $app->service('pessoa.repository');
            $repositoryCadastro = $app->service('user.repository');

            $idCadastro = $request->getAttribute('id');
            $data = $request->getParsedBody();
            $dataPessoa = ['nome' => $data['nome'], 'email' => $data['email'], 'telefone' => $data['telefone']];
            $dataCadastro = ['usuario' => $data['email']];
            $data['senha'] != '' ? $dataCadastro = ['senha' => $auth->hashPassword($data['senha'])] : '';

            $repositoryCad = $repositoryCadastro->update($idCadastro, $dataCadastro);
            $repositoryPessoa->update($repositoryCad->idPessoa, $dataPessoa);
            return $app->route('admin.cadastros.list');
        }, 'admin.cadastros.update'
    )
    ->get(
        '/admin/Cadastros/{id}/status/{status}', function (ServerRequestInterface $request) use ($app) {
            $auth = $app->service('auth');
            $repositoryCadastro = $app->service('user.repository');
            $idCadastro = $request->getAttribute('id');
            $dataStatus = ['status' => $request->getAttribute('status')];
            $repositoryCadastro->update($idCadastro, $dataStatus);

            return $app->route('admin.cadastros.list');
        }, 'admin.cadastros.status'
    );

