<?php

namespace ContainerBZladL5;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getUserFinderService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Service\UserFinder' shared autowired service.
     *
     * @return \App\Service\UserFinder
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Service/UserFinder.php';

        $a = ($container->services['lexik_jwt_authentication.jwt_manager'] ?? $container->load('getLexikJwtAuthentication_JwtManagerService'));

        if (isset($container->privates['App\\Service\\UserFinder'])) {
            return $container->privates['App\\Service\\UserFinder'];
        }

        return $container->privates['App\\Service\\UserFinder'] = new \App\Service\UserFinder(($container->privates['security.token_storage'] ?? self::getSecurity_TokenStorageService($container)), $a, ($container->privates['App\\Repository\\UserRepository'] ?? $container->load('getUserRepositoryService')));
    }
}