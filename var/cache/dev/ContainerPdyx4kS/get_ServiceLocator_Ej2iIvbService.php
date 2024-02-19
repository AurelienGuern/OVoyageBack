<?php

namespace ContainerPdyx4kS;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_Ej2iIvbService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.ej2iIvb' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.ej2iIvb'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'userVerification' => ['privates', 'App\\Service\\UserVerification', 'getUserVerificationService', true],
        ], [
            'userVerification' => 'App\\Service\\UserVerification',
        ]);
    }
}
