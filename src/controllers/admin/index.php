<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 04/06/17
 * Time: 15:59
 */
$app
    ->get(
        '/admin', function () use ($app) {
            $view = $app->service('view.renderer');
            return $view->render('/admin/index.html.twig', [
                'menu' => 'index'
            ]);
        }, 'admin.index'
//    )
//    ->get(
//        '/admin', function () use ($app) {
//            return $app->route('admin.index');
//        }, 'admin.index.redirect'
    );

