<?php

namespace ContainerBZladL5;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getFriendController2Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\Controller\Back\FriendController' shared autowired service.
     *
     * @return \App\Controller\Back\FriendController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/Back/FriendController.php';

        $container->services['App\\Controller\\Back\\FriendController'] = $instance = new \App\Controller\Back\FriendController();

        $instance->setContainer(($container->privates['.service_locator.O2p6Lk7'] ?? $container->load('get_ServiceLocator_O2p6Lk7Service'))->withContext('App\\Controller\\Back\\FriendController', $container));

        return $instance;
    }
}