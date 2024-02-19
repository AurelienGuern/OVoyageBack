<?php

namespace ContainerPdyx4kS;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_8SvkcYFService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.8SvkcYF' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.8SvkcYF'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'em' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'userVerification' => ['privates', 'App\\Service\\UserVerification', 'getUserVerificationService', true],
            'vr' => ['privates', 'App\\Repository\\VoteRepository', 'getVoteRepositoryService', true],
        ], [
            'em' => '?',
            'userVerification' => 'App\\Service\\UserVerification',
            'vr' => 'App\\Repository\\VoteRepository',
        ]);
    }
}