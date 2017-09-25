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
        '/admin/Glossarios', function () use ($app) {
            $view = $app->service('view.renderer');
            $auth = $app->service('auth');
            $repositoryGlossario = $app->service('glossarios.repository');
            $glossarios = $repositoryGlossario->all();

            return $view->render(
                '/admin/Glossarios/list.html.twig', [
                    'glossarios' => $glossarios,
                    'menu' => 'glossarios'
                ]
            );
        }, 'admin.glossarios.list'
    )
    ->get(
        '/admin/Glossarios/', function () use ($app) {
            return $app->route('admin.glossarios.list');
        }, 'admin.glossarios.redirect'
    )
    ->get(
        '/admin/Glossarios/new', function () use ($app) {
            $view = $app->service('view.renderer');
            return $view->render('admin/Glossarios/create.html.twig', [
                'menu' => 'glossarios'
            ]);
        }, 'admin.glossarios.new'
    )
    ->post(
        '/admin/Glossarios/store', function (ServerRequestInterface $request) use ($app) {
            $data = $request->getParsedBody();
            $data['status'] = 1;
            $repository = $app->service('glossarios.repository');

            if (!isset($_FILES['imagem'])) {
                echo "Nenhum arquivo selecionado!!";
                return;
            }

            $imgs = array();

            $files = $_FILES['imagem'];
            $name = uniqid('img-'.date('Ymd').'-') . '.' . end(explode(".", $files['name']));
            if ($files['error'] === 0) {
                if (move_uploaded_file($files['tmp_name'], __DIR__ . '/../../../public/assets/imagens/glossario/' . $name)) {
                    $data['imagem'] = $name;
                    $repository->create($data);
                    return $app->route('admin.glossarios.list');
                }else{
                    return $app->route('admin.glossarios.new');
                }
            }
        }, 'admin.glossarios.store'
    )
    ->get(
        '/admin/Glossarios/{id}/edit', function (ServerRequestInterface $request) use ($app) {
            $view = $app->service('view.renderer');
            $id = $request->getAttribute('id');
            $repository = $app->service('glossarios.repository');
            $glossarios = $repository->findOneBy(
                ['id' => $id]
            );
            return $view->render(
                '/admin/Glossarios/edit.html.twig', [
                    'glossarios' => $glossarios,
                    'menu' => 'continentes'
                ]
            );
        }, 'admin.glossarios.edit'
    )
    ->post(
        '/admin/Glossarios/{id}/update', function (ServerRequestInterface $request) use ($app) {
            $repository = $app->service('glossarios.repository');
            $id = $request->getAttribute('id');
            $data = $request->getParsedBody();

            $imgs = array();
            $files = $_FILES['imagem'];
            $name = uniqid('img-'.date('Ymd').'-') . '.' . end(explode(".", $files['name']));
            if ($files['error'] === 0) {
                if (move_uploaded_file($files['tmp_name'], __DIR__ . '/../../../public/assets/imagens/glossario/' . $name)) {
                    $data['imagem'] = $name;
                }
            }

            $repository->update($id, $data);
            return $app->route('admin.glossarios.list');
        }, 'admin.glossarios.update'
    )
    ->get(
        '/admin/Glossarios/{id}/status/{status}', function (ServerRequestInterface $request) use ($app) {
            $repository = $app->service('glossarios.repository');
            $id = $request->getAttribute('id');
            $data = ['status' => $request->getAttribute('status')];
            $repository->update($id, $data);

            return $app->route('admin.glossarios.list');
        }, 'admin.glossarios.status'
    );

