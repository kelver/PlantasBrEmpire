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
use PlantasBr\Models\CaracteresEspeciais;
use PlantasBr\Models\Categorias;
use PlantasBr\Models\Contatos;
use PlantasBr\Models\Continentes;
use PlantasBr\Models\Especies;
use PlantasBr\Models\Estados;
use PlantasBr\Models\Generos;
use PlantasBr\Models\Glossario;
use PlantasBr\Models\mapeamentosPlantas;
use PlantasBr\Models\Origens;
use PlantasBr\Models\Paises;
use PlantasBr\Models\Pessoa;
use PlantasBr\Models\Plantas;
use PlantasBr\Models\plantasCaracteres;
use PlantasBr\Models\plantasCategorias;
use PlantasBr\Models\plantasContinentes;
use PlantasBr\Models\plantasEspecies;
use PlantasBr\Models\plantasEstados;
use PlantasBr\Models\plantasPaises;
use PlantasBr\Models\plantasRegioes;
use PlantasBr\Models\Referencia;
use PlantasBr\Models\Regioes;
use PlantasBr\Models\TipoFolha;
use PlantasBr\Models\videosPlantas;
use PlantasBr\Repository\RepositoryFactory;
use PlantasBr\ServiceContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;

class DbPlugin implements PluginInterface
{

    public function register(ServiceContainerInterface $container)
    {
        $capsule = new Capsule();
        $config = include __DIR__ . '/../../config/db.php';
        $capsule->addConnection($config['default_connection']);
        $capsule->bootEloquent();

        $container->add('repository.factory', new RepositoryFactory());

        $container->addLazy(
            'contatos.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(Contatos::class);
            }
        );
        $container->addLazy(
            'especies.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(Especies::class);
            }
        );
        $container->addLazy(
            'referencias.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(Referencia::class);
            }
        );
        $container->addLazy(
            'glossarios.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(Glossario::class);
            }
        );
        $container->addLazy(
                'perfilCad.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(Cadastros::class);
            }
        );
        $container->addLazy(
                'perfilPess.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(Pessoa::class);
            }
        );

        // repositórios admin
        $container->addLazy(
            'user.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(Cadastros::class);
            }
        );
        $container->addLazy(
            'pessoa.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(Pessoa::class);
            }
        );
        $container->addLazy(
            'categorias.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(Categorias::class);
            }
        );
        $container->addLazy(
            'especies.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(Especies::class);
            }
        );
        $container->addLazy(
            'continentes.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(Continentes::class);
            }
        );
        $container->addLazy(
            'generos.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(Generos::class);
            }
        );
        $container->addLazy(
            'origens.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(Origens::class);
            }
        );
        $container->addLazy(
            'paises.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(Paises::class);
            }
        );
        $container->addLazy(
            'tipoFolha.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(TipoFolha::class);
            }
        );
        $container->addLazy(
            'glossarios.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(Glossario::class);
            }
        );
        $container->addLazy(
            'referencias.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(Referencia::class);
            }
        );
        $container->addLazy(
            'caracteresEspeciais.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(CaracteresEspeciais::class);
            }
        );

        $container->addLazy(
            'plantas.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(Plantas::class);
            }
        );

        $container->addLazy(
            'estados.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(Estados::class);
            }
        );

        $container->addLazy(
            'regioes.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(Regioes::class);
            }
        );

        $container->addLazy(
            'caracteres.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(CaracteresEspeciais::class);
            }
        );


        // Criação de planta
        $container->addLazy(
            'plantasEstados.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(plantasEstados::class);
            }
        );
        $container->addLazy(
            'plantasContinentes.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(plantasContinentes::class);
            }
        );
        $container->addLazy(
            'plantasRegioes.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(plantasRegioes::class);
            }
        );
        $container->addLazy(
            'plantasPaises.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(plantasPaises::class);
            }
        );
        $container->addLazy(
            'plantasCategorias.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(plantasCategorias::class);
            }
        );
        $container->addLazy(
            'plantasCaracteres.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(plantasCaracteres::class);
            }
        );
        $container->addLazy(
            'videos.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(videosPlantas::class);
            }
        );
        $container->addLazy(
            'map.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(mapeamentosPlantas::class);
            }
        );
    }
}