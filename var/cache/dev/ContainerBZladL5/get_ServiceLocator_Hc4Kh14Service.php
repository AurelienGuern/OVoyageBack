<?php

namespace ContainerBZladL5;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_Hc4Kh14Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.Hc4Kh14' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.Hc4Kh14'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'item' => ['privates', '.errored..service_locator.Hc4Kh14.App\\Entity\\Item', NULL, 'Cannot autowire service ".service_locator.Hc4Kh14": it needs an instance of "App\\Entity\\Item" but this type has been excluded in "config/services.yaml".'],
            'serializer' => ['privates', 'debug.serializer', 'getDebug_SerializerService', false],
            'userVerification' => ['privates', 'App\\Service\\UserVerification', 'getUserVerificationService', true],
            'validator' => ['privates', 'debug.validator', 'getDebug_ValidatorService', false],
        ], [
            'entityManager' => '?',
            'item' => 'App\\Entity\\Item',
            'serializer' => '?',
            'userVerification' => 'App\\Service\\UserVerification',
            'validator' => '?',
        ]);
    }
}
