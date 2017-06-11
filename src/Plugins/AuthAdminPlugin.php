<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 23/05/17
 * Time: 22:36
 */
declare(strict_types=1);

namespace PlantasBr\Plugins;

use Interop\Container\ContainerInterface;
use PlantasBr\Auth\Admin\AuthAdmin;
use PlantasBr\Auth\Admin\JasnyAuthAdmin;
use PlantasBr\ServiceContainerInterface;

class AuthAdminPlugin implements PluginInterface
{

    public function register(ServiceContainerInterface $container)
    {
        $container->addLazy('jasny.auth.admin', function(ContainerInterface $container){
            return new JasnyAuthAdmin($container->get('userAdm.repository'));
        });
        $container->addLazy('auth.admin', function(ContainerInterface $container){
            return new AuthAdmin($container->get('jasny.auth.admin'));
        });
    }
}