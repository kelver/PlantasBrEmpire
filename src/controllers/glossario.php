<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 04/06/17
 * Time: 15:59
 */
$app
    ->get(
        '/glossario', function () use ($app) {
            $view = $app->service('view.renderer');
            $repositoryEspecies = $app->service('especies.repository');
            $repositoryGlossario = $app->service('glossarios.repository');

            return $view->render(
                'glossario.html.twig', [
                    'especies' => $repositoryEspecies->all(),
                    'glossarios' => $repositoryGlossario->all()
                ]
            );
        }
    );