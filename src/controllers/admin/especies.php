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
        '/admin/Especies', function () use ($app) {
            $view = $app->service('view.renderer');
            $auth = $app->service('auth');
            $repositoryEspecie = $app->service('especies.repository');
            $especies = $repositoryEspecie->all();

            return $view->render(
                '/admin/Especies/list.html.twig', [
                'especies' => $especies
                ]
            );
        }, 'admin.especies.list'
    )
    ->get(
        '/admin/Especies/', function () use ($app) {
            return $app->route('admin.especies.list');
        }, 'admin.especies.redirect'
    )
    ->get(
        '/admin/Especies/new', function () use ($app) {
            $view = $app->service('view.renderer');
            return $view->render('admin/Especies/create.html.twig');
        }, 'admin.especies.new'
    )
    ->post(
        '/admin/Especies/store', function (ServerRequestInterface $request) use ($app) {
            $data = $request->getParsedBody();
            $data['status'] = 1;
            $repository = $app->service('especies.repository');

            if (!isset($_FILES['imagem'])) {
                echo "Nenhum arquivo selecionado!!";
                return;
            }

            $imgs = array();

            $files = $_FILES['imagem'];
            $name = uniqid('img-'.date('Ymd').'-') . '.' . end(explode(".", $files['name']));
            if ($files['error'] === 0) {
                if (move_uploaded_file($files['tmp_name'], __DIR__ . '/../../../public/assets/imagens/especies/' . $name)) {
                    $data['imagem'] = $name;
                    $repository->create($data);
                    return $app->route('admin.especies.list');
                }else{
                    return $app->route('admin.especies.new');
                }
            }
        }, 'admin.especies.store'
    )
    ->get(
        '/admin/Especies/{id}/edit', function (ServerRequestInterface $request) use ($app) {
            $view = $app->service('view.renderer');
            $id = $request->getAttribute('id');
            $repository = $app->service('especies.repository');
            $especies = $repository->findOneBy(
                ['id' => $id]
            );
            return $view->render(
                '/admin/Especies/edit.html.twig', [
                'especies' => $especies
                ]
            );
        }, 'admin.especies.edit'
    )
    ->post(
        '/admin/Especies/{id}/update', function (ServerRequestInterface $request) use ($app) {
            $repository = $app->service('especies.repository');
            $id = $request->getAttribute('id');
            $data = $request->getParsedBody();

            $imgs = array();
            $files = $_FILES['imagem'];
            $name = uniqid('img-'.date('Ymd').'-') . '.' . end(explode(".", $files['name']));
            if ($files['error'] === 0) {
                if (move_uploaded_file($files['tmp_name'], __DIR__ . '/../../../public/assets/imagens/especies/' . $name)) {
                    $data['imagem'] = $name;
                }
            }

            $repository->update($id, $data);
            return $app->route('admin.especies.list');
        }, 'admin.especies.update'
    )
    ->get(
        '/admin/Especies/{id}/status/{status}', function (ServerRequestInterface $request) use ($app) {
            $repository = $app->service('especies.repository');
            $id = $request->getAttribute('id');
            $data = ['status' => $request->getAttribute('status')];
            $repository->update($id, $data);

            return $app->route('admin.especies.list');
        }, 'admin.especies.status'
    );

