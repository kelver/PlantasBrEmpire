<?php
use Psr\Http\Message\ServerRequestInterface;

$app
    ->get(
        '/perfil', function () use ($app) {
            $view = $app->service('view.renderer');
            $auth = $app->service('auth');
            $repository = $app->service('especie.repository');
            $repositoryCadastro = $app->service('perfilCad.repository');
            $repositoryPessoa = $app->service('perfilPess.repository');

            $usuario = $repositoryCadastro->findOneBy(
                ['id'=>$auth->user()['id']]
            );
            $pessoa = $repositoryPessoa->findOneBy(
                ['id'=>$usuario['idPessoa']]
            );

            return
                $view->render(
                    'Perfil/show.html.twig', [
                        'pessoa' => $pessoa,
                        'usuario' => $usuario,
                        'especies' => $repository->all()
                ]
            );
        }, 'perfil'
    );