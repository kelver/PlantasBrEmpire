<?php
use Psr\Http\Message\ServerRequestInterface;

$app
    ->get(
        '/Especies', function () use ($app) {
            $view = $app->service('view.renderer');
            $repository = $app->service('especies.repository');

            return $view->render(
                'Especies/list.html.twig', [
                    'especies' => $repository->all()
                ]
            );
        }, 'especies'
    )
    ->get(
        '/Especies/', function () use ($app) {
            return $app->route('especies');
        }, 'especies.redirect'
    )
    ->get(
        '/Especies/{id}', function (ServerRequestInterface $request) use ($app) {
            $view = $app->service('view.renderer');
            $id = $request->getAttribute('id');
            $repository = $app->service('especies.repository');
            $especies = $repository->findOneBy(
                ['id' => $id]
            );
            return $view->render(
                'Especies/show.html.twig', [
                    'especies' => $repository->all(),
                    'especieShow' => $especies
                ]
            );
        }, 'especies.show'
    );