<?php

namespace ContainerBZladL5;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_Y8qz20BService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.y8qz20B' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.y8qz20B'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'friend' => ['privates', '.errored..service_locator.y8qz20B.App\\Entity\\Friend', NULL, 'Cannot autowire service ".service_locator.y8qz20B": it needs an instance of "App\\Entity\\Friend" but this type has been excluded in "config/services.yaml".'],
        ], [
            'entityManager' => '?',
            'friend' => 'App\\Entity\\Friend',
        ]);
    }
}