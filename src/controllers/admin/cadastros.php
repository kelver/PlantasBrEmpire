<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 04/06/17
 * Time: 15:59
 */
$app
    ->get('/admin/cadastros', function() use ($app){
        $view = $app->service('view.renderer');
        $repositoryCadastro = $app->service('user.repository');
        $repositoryPessoa = $app->service('pessoa.repository');

//        print_r("<pre>");
//        print_r($repositoryPessoa->where(''));
//        die("cad");

        return $view->render('/admin/cadastros.html.twig', [
            'cadastros' => $repositoryCadastro->all()
        ]);
    }, 'admin.cadastros.list')
    ->get('/admin/cadastros/', function() use ($app){
        return $app->route('admin.cadastros.list');
    }, 'admin.cadastros.redirect');

