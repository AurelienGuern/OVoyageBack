<?php

namespace ContainerBZladL5;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_WGKkuxhService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.WGKkuxh' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.WGKkuxh'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'em' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'serializer' => ['privates', 'debug.serializer', 'getDebug_SerializerService', false],
            'userVerification' => ['privates', 'App\\Service\\UserVerification', 'getUserVerificationService', true],
            'validator' => ['privates', 'debug.validator', 'getDebug_ValidatorService', false],
            'vr' => ['privates', 'App\\Repository\\VoteRepository', 'getVoteRepositoryService', true],
        ], [
            'em' => '?',
            'serializer' => '?',
            'userVerification' => 'App\\Service\\UserVerification',
            'validator' => '?',
            'vr' => 'App\\Repository\\VoteRepository',
        ]);
    }
}
