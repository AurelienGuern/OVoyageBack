<?php

namespace ContainerBZladL5;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_J4pAXxdService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.j4pAXxd' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.j4pAXxd'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'item' => ['privates', '.errored..service_locator.j4pAXxd.App\\Entity\\Item', NULL, 'Cannot autowire service ".service_locator.j4pAXxd": it needs an instance of "App\\Entity\\Item" but this type has been excluded in "config/services.yaml".'],
        ], [
            'item' => 'App\\Entity\\Item',
        ]);
    }
}