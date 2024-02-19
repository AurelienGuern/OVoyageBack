<?php

namespace ContainerBZladL5;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getImageHandlerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Service\ImageHandler' shared autowired service.
     *
     * @return \App\Service\ImageHandler
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Service/ImageHandler.php';

        return $container->privates['App\\Service\\ImageHandler'] = new \App\Service\ImageHandler(($container->privates['parameter_bag'] ??= new \Symfony\Component\DependencyInjection\ParameterBag\ContainerBag($container)));
    }
}
