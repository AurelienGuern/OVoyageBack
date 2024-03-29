<?php

namespace ContainerPdyx4kS;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getTripControllerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\Controller\Api\TripController' shared autowired service.
     *
     * @return \App\Controller\Api\TripController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/Api/TripController.php';

        $container->services['App\\Controller\\Api\\TripController'] = $instance = new \App\Controller\Api\TripController(($container->privates['App\\Service\\UserFinder'] ?? $container->load('getUserFinderService')));

        $instance->setContainer(($container->privates['.service_locator.O2p6Lk7'] ?? $container->load('get_ServiceLocator_O2p6Lk7Service'))->withContext('App\\Controller\\Api\\TripController', $container));

        return $instance;
    }
}
