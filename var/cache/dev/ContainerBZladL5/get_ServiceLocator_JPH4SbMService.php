<?php

namespace ContainerBZladL5;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_JPH4SbMService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.jPH4SbM' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.jPH4SbM'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'em' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'serializer' => ['privates', 'debug.serializer', 'getDebug_SerializerService', false],
            'trip' => ['privates', '.errored..service_locator.jPH4SbM.App\\Entity\\Trip', NULL, 'Cannot autowire service ".service_locator.jPH4SbM": it needs an instance of "App\\Entity\\Trip" but this type has been excluded in "config/services.yaml".'],
            'userVerification' => ['privates', 'App\\Service\\UserVerification', 'getUserVerificationService', true],
            'validator' => ['privates', 'debug.validator', 'getDebug_ValidatorService', false],
        ], [
            'em' => '?',
            'serializer' => '?',
            'trip' => 'App\\Entity\\Trip',
            'userVerification' => 'App\\Service\\UserVerification',
            'validator' => '?',
        ]);
    }
}
