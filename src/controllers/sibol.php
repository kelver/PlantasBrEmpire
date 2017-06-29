<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 04/06/17
 * Time: 15:59
 */
$app
    ->get(
        '/sibol', function () use ($app) {
            $view = $app->service('view.renderer');
            $repository = $app->service('especies.repository');

            return $view->render(
                'sibol.html.twig', [
                'especies' => $repository->all()
                ]
            );
        }
    );