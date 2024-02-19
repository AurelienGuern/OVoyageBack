<?php

namespace ContainerPdyx4kS;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_Irvp3WxService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.Irvp3Wx' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.Irvp3Wx'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'em' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'friend' => ['privates', '.errored..service_locator.Irvp3Wx.App\\Entity\\Friend', NULL, 'Cannot autowire service ".service_locator.Irvp3Wx": it needs an instance of "App\\Entity\\Friend" but this type has been excluded in "config/services.yaml".'],
            'friendRepository' => ['privates', 'App\\Repository\\FriendRepository', 'getFriendRepositoryService', true],
        ], [
            'em' => '?',
            'friend' => 'App\\Entity\\Friend',
            'friendRepository' => 'App\\Repository\\FriendRepository',
        ]);
    }
}