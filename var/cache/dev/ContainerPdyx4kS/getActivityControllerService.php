<?php

namespace ContainerPdyx4kS;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getActivityControllerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\Controller\Api\ActivityController' shared autowired service.
     *
     * @return \App\Controller\Api\ActivityController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/Api/ActivityController.php';

        $container->services['App\\Controller\\Api\\ActivityController'] = $instance = new \App\Controller\Api\ActivityController(($container->privates['App\\Service\\UserFinder'] ?? $container->load('getUserFinderService')));

        $instance->setContainer(($container->privates['.service_locator.O2p6Lk7'] ?? $container->load('get_ServiceLocator_O2p6Lk7Service'))->withContext('App\\Controller\\Api\\ActivityController', $container));

        return $instance;
    }
}
