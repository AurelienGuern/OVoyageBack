<?php

namespace ContainerBZladL5;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_3m_Cxc7Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.3m.cxc7' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.3m.cxc7'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'em' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'userRepository' => ['privates', 'App\\Repository\\UserRepository', 'getUserRepositoryService', true],
            'userVerification' => ['privates', 'App\\Service\\UserVerification', 'getUserVerificationService', true],
        ], [
            'em' => '?',
            'userRepository' => 'App\\Repository\\UserRepository',
            'userVerification' => 'App\\Service\\UserVerification',
        ]);
    }
}
