<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 21/05/17
 * Time: 02:38
 */
declare(strict_types=1);
namespace PlantasBr;

use PlantasBr\Plugins\PluginInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\Response\SapiEmitter;

class Application
{
    private $ServiceContainer;

    /**
     * Application constructor.
     * @param $ServiceContainer
     */
    public function __construct(ServiceContainerInterface $ServiceContainer)
    {
        $this->serviceContainer = $ServiceContainer;
    }

    public function service($name)
    {
        return $this->serviceContainer->get($name);
    }

    public function addService(string $name, $service): void
    {
        if (is_callable($service)) {
            $this->serviceContainer->addLazy($name, $service);
        } else {
            $this->serviceContainer->add($name, $service);
        }
    }

    public function plugin(PluginInterface $plugin): void
    {
        $plugin->register($this->serviceContainer);
    }

    public function get($path, $action, $name = null):Application
    {
        $routing =$this->service('routing');
        $routing->get($name, $path, $action);
        return $this;
    }

    public function post($path, $action, $name = null):Application
    {
        $routing =$this->service('routing');
        $routing->post($name, $path, $action);
        return $this;
    }

    public function redirect($path)
    {
        return new RedirectResponse($path);
    }

    public function route(string $name, array $params = [])
    {
        $generator = $this->service('routing.generator');
        $path = $generator->generate($name, $params);
        return $this->redirect($path);
    }

    public function start(){
        $route = $this->service('route');

        // phpDoc para autocomplete :p
        /** @var ServerRequestInterface $request */
        $request = $this->service(RequestInterface::class);

        if(!$route){
            echo "Page not found.";
            exit;
        }

        foreach($route->attributes as $key => $value){
            $request = $request->withAttribute($key, $value);
        }

        $callable = $route->handler;
        $response = $callable($request);
        $this->emitResponse($response);
    }

    private function emitResponse(ResponseInterface $response)
    {
        $emitter = new SapiEmitter();
        $emitter->emit($response);
    }
}