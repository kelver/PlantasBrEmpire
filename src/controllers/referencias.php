<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 04/06/17
 * Time: 15:59
 */
$app
    ->get(
        '/referencias', function () use ($app) {
            $view = $app->service('view.renderer');
            $repositoryEspecies = $app->service('especies.repository');
            $repositoryReferencias = $app->service('referencias.repository');

            return $view->render(
                'referencias.html.twig', [
                'especies' => $repositoryEspecies->all(),
                'referencias' => $repositoryReferencias->all()
                ]
            );
        }
    );