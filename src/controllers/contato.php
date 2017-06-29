<?php
use Psr\Http\Message\ServerRequestInterface;

$app
    ->get(
        '/contato', function () use ($app) {
            $view = $app->service('view.renderer');
            $repository = $app->service('especies.repository');

            return $view->render(
                'contato.html.twig', [
                'especies' => $repository->all()
                ]
            );
        }, 'contato'
    )
    ->post(
        '/contato/envia', function (ServerRequestInterface $request) use ($app) {
            $repository = $app->service('contatos.repository');
            $data = $request->getParsedBody();
            $data['data'] = date('Y-m-d H:i:s');
            $repository->create($data);
            return $app->route('contato');
        }, 'contato.envia'
    );