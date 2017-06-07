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
use PlantasBr\Models\Cadastros;
use PlantasBr\Models\Contatos;
use PlantasBr\Models\Especies;
use PlantasBr\Repository\RepositoryFactory;
use PlantasBr\ServiceContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;

class DbPlugin implements PluginInterface
{

    public function register(ServiceContainerInterface $container)
    {
        $capsule = new Capsule();
        $config = include(__DIR__ . '/../../config/db.php');
        $capsule->addConnection($config['development']);
        $capsule->bootEloquent();

        $container->add('repository.factory', new RepositoryFactory());

        $container->addLazy('contatos.repository', function(ContainerInterface $container){
            return $container->get('repository.factory')->factory(Contatos::class);
        });
        $container->addLazy('especies.repository', function(ContainerInterface $container){
            return $container->get('repository.factory')->factory(Especies::class);
        });
        $container->addLazy('user.repository', function (ContainerInterface $container) {
            return $container->get('repository.factory')->factory(Cadastros::class);
        });
    }
}