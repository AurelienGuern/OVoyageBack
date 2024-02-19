<?php

namespace ContainerBZladL5;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_JOCFIkaService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.jOCFIka' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.jOCFIka'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'App\\Controller\\Api\\ActivityController::add' => ['privates', '.service_locator.wqezqEJ', 'get_ServiceLocator_WqezqEJService', true],
            'App\\Controller\\Api\\ActivityController::addTag' => ['privates', '.service_locator.I2EF6XW', 'get_ServiceLocator_I2EF6XWService', true],
            'App\\Controller\\Api\\ActivityController::browseByTrip' => ['privates', '.service_locator.S_M4X.a', 'get_ServiceLocator_SM4X_AService', true],
            'App\\Controller\\Api\\ActivityController::browseByTripThenCity' => ['privates', '.service_locator.Wy5MKOG', 'get_ServiceLocator_Wy5MKOGService', true],
            'App\\Controller\\Api\\ActivityController::browseByTripThenCityThenTag' => ['privates', '.service_locator.0VsW5S3', 'get_ServiceLocator_0VsW5S3Service', true],
            'App\\Controller\\Api\\ActivityController::browseByTripThenDay' => ['privates', '.service_locator.94OwKQV', 'get_ServiceLocator_94OwKQVService', true],
            'App\\Controller\\Api\\ActivityController::browseByTripThenDayThenTag' => ['privates', '.service_locator.ej2iIvb', 'get_ServiceLocator_Ej2iIvbService', true],
            'App\\Controller\\Api\\ActivityController::browseByTripThenTag' => ['privates', '.service_locator.8vCQfZ.', 'get_ServiceLocator_8vCQfZ_Service', true],
            'App\\Controller\\Api\\ActivityController::delete' => ['privates', '.service_locator.ZzEIOBS', 'get_ServiceLocator_ZzEIOBSService', true],
            'App\\Controller\\Api\\ActivityController::edit' => ['privates', '.service_locator._8ReKT7', 'get_ServiceLocator_8ReKT7Service', true],
            'App\\Controller\\Api\\ActivityController::read' => ['privates', '.service_locator.bDMu.SW', 'get_ServiceLocator_BDMu_SWService', true],
            'App\\Controller\\Api\\ActivityController::removeTag' => ['privates', '.service_locator.I2EF6XW', 'get_ServiceLocator_I2EF6XWService', true],
            'App\\Controller\\Api\\CityController::browse' => ['privates', '.service_locator.mkff3Zb', 'get_ServiceLocator_Mkff3ZbService', true],
            'App\\Controller\\Api\\CityController::read' => ['privates', '.service_locator.ycxdVNz', 'get_ServiceLocator_YcxdVNzService', true],
            'App\\Controller\\Api\\CountryController::addAvatar' => ['privates', '.service_locator.uZuct7W', 'get_ServiceLocator_UZuct7WService', true],
            'App\\Controller\\Api\\CountryController::browse' => ['privates', '.service_locator.2goNfau', 'get_ServiceLocator_2goNfauService', true],
            'App\\Controller\\Api\\CountryController::browseByCountry' => ['privates', '.service_locator.CvcttIg', 'get_ServiceLocator_CvcttIgService', true],
            'App\\Controller\\Api\\CountryController::deleteAvatar' => ['privates', '.service_locator.uZuct7W', 'get_ServiceLocator_UZuct7WService', true],
            'App\\Controller\\Api\\FriendController::add' => ['privates', '.service_locator.7m.qcGn', 'get_ServiceLocator_7m_QcGnService', true],
            'App\\Controller\\Api\\FriendController::delete' => ['privates', '.service_locator.gajgELK', 'get_ServiceLocator_GajgELKService', true],
            'App\\Controller\\Api\\FriendController::edit' => ['privates', '.service_locator.gajgELK', 'get_ServiceLocator_GajgELKService', true],
            'App\\Controller\\Api\\ItemController::add' => ['privates', '.service_locator.jPH4SbM', 'get_ServiceLocator_JPH4SbMService', true],
            'App\\Controller\\Api\\ItemController::browseBySuitcase' => ['privates', '.service_locator..ePpOA0', 'get_ServiceLocator__EPpOA0Service', true],
            'App\\Controller\\Api\\ItemController::delete' => ['privates', '.service_locator.KQbHgo6', 'get_ServiceLocator_KQbHgo6Service', true],
            'App\\Controller\\Api\\ItemController::edit' => ['privates', '.service_locator.Hc4Kh14', 'get_ServiceLocator_Hc4Kh14Service', true],
            'App\\Controller\\Api\\TripController::add' => ['privates', '.service_locator.jYQR168', 'get_ServiceLocator_JYQR168Service', true],
            'App\\Controller\\Api\\TripController::addCity' => ['privates', '.service_locator.qFLMMyM', 'get_ServiceLocator_QFLMMyMService', true],
            'App\\Controller\\Api\\TripController::addPicture' => ['privates', '.service_locator.3kZFhbf', 'get_ServiceLocator_3kZFhbfService', true],
            'App\\Controller\\Api\\TripController::addTraveler' => ['privates', '.service_locator.nhWMSMU', 'get_ServiceLocator_NhWMSMUService', true],
            'App\\Controller\\Api\\TripController::delete' => ['privates', '.service_locator.OrqEcoY', 'get_ServiceLocator_OrqEcoYService', true],
            'App\\Controller\\Api\\TripController::deletePicture' => ['privates', '.service_locator.3kZFhbf', 'get_ServiceLocator_3kZFhbfService', true],
            'App\\Controller\\Api\\TripController::edit' => ['privates', '.service_locator.sxTVA_v', 'get_ServiceLocator_SxTVAVService', true],
            'App\\Controller\\Api\\TripController::leaveTrip' => ['privates', '.service_locator.3m.cxc7', 'get_ServiceLocator_3m_Cxc7Service', true],
            'App\\Controller\\Api\\TripController::read' => ['privates', '.service_locator.S_M4X.a', 'get_ServiceLocator_SM4X_AService', true],
            'App\\Controller\\Api\\TripController::removeCity' => ['privates', '.service_locator.X4KLEsU', 'get_ServiceLocator_X4KLEsUService', true],
            'App\\Controller\\Api\\TripController::removeTraveler' => ['privates', '.service_locator.UFJqWKI', 'get_ServiceLocator_UFJqWKIService', true],
            'App\\Controller\\Api\\TripController::showTravelers' => ['privates', '.service_locator.S_M4X.a', 'get_ServiceLocator_SM4X_AService', true],
            'App\\Controller\\Api\\UserController::add' => ['privates', '.service_locator.u7Urtal', 'get_ServiceLocator_U7UrtalService', true],
            'App\\Controller\\Api\\UserController::addAvatar' => ['privates', '.service_locator.RWvOErq', 'get_ServiceLocator_RWvOErqService', true],
            'App\\Controller\\Api\\UserController::delete' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\Api\\UserController::deleteAvatar' => ['privates', '.service_locator.RWvOErq', 'get_ServiceLocator_RWvOErqService', true],
            'App\\Controller\\Api\\UserController::edit' => ['privates', '.service_locator.88sPeAh', 'get_ServiceLocator_88sPeAhService', true],
            'App\\Controller\\Api\\UserController::searchUser' => ['privates', '.service_locator.kPUOGb8', 'get_ServiceLocator_KPUOGb8Service', true],
            'App\\Controller\\Api\\VoteController::add' => ['privates', '.service_locator.WGKkuxh', 'get_ServiceLocator_WGKkuxhService', true],
            'App\\Controller\\Api\\VoteController::delete' => ['privates', '.service_locator.8SvkcYF', 'get_ServiceLocator_8SvkcYFService', true],
            'App\\Controller\\Api\\VoteController::read' => ['privates', '.service_locator.bDMu.SW', 'get_ServiceLocator_BDMu_SWService', true],
            'App\\Controller\\Back\\ActivityController::delete' => ['privates', '.service_locator.tXjO4lr', 'get_ServiceLocator_TXjO4lrService', true],
            'App\\Controller\\Back\\ActivityController::edit' => ['privates', '.service_locator.tXjO4lr', 'get_ServiceLocator_TXjO4lrService', true],
            'App\\Controller\\Back\\ActivityController::index' => ['privates', '.service_locator.eRk71wc', 'get_ServiceLocator_ERk71wcService', true],
            'App\\Controller\\Back\\ActivityController::new' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\Back\\ActivityController::show' => ['privates', '.service_locator.fvysUnv', 'get_ServiceLocator_FvysUnvService', true],
            'App\\Controller\\Back\\CityController::delete' => ['privates', '.service_locator.jyxuf8o', 'get_ServiceLocator_Jyxuf8oService', true],
            'App\\Controller\\Back\\CityController::edit' => ['privates', '.service_locator.jyxuf8o', 'get_ServiceLocator_Jyxuf8oService', true],
            'App\\Controller\\Back\\CityController::index' => ['privates', '.service_locator.mkff3Zb', 'get_ServiceLocator_Mkff3ZbService', true],
            'App\\Controller\\Back\\CityController::new' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\Back\\CityController::show' => ['privates', '.service_locator.ycxdVNz', 'get_ServiceLocator_YcxdVNzService', true],
            'App\\Controller\\Back\\CountryController::delete' => ['privates', '.service_locator.cDqCNLH', 'get_ServiceLocator_CDqCNLHService', true],
            'App\\Controller\\Back\\CountryController::edit' => ['privates', '.service_locator.cDqCNLH', 'get_ServiceLocator_CDqCNLHService', true],
            'App\\Controller\\Back\\CountryController::index' => ['privates', '.service_locator.2goNfau', 'get_ServiceLocator_2goNfauService', true],
            'App\\Controller\\Back\\CountryController::new' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\Back\\CountryController::show' => ['privates', '.service_locator.CvcttIg', 'get_ServiceLocator_CvcttIgService', true],
            'App\\Controller\\Back\\FriendController::delete' => ['privates', '.service_locator.y8qz20B', 'get_ServiceLocator_Y8qz20BService', true],
            'App\\Controller\\Back\\FriendController::edit' => ['privates', '.service_locator.y8qz20B', 'get_ServiceLocator_Y8qz20BService', true],
            'App\\Controller\\Back\\FriendController::index' => ['privates', '.service_locator.9lTe6Db', 'get_ServiceLocator_9lTe6DbService', true],
            'App\\Controller\\Back\\FriendController::new' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\Back\\FriendController::show' => ['privates', '.service_locator.avfua8H', 'get_ServiceLocator_Avfua8HService', true],
            'App\\Controller\\Back\\ItemController::delete' => ['privates', '.service_locator.a8_8NHO', 'get_ServiceLocator_A88NHOService', true],
            'App\\Controller\\Back\\ItemController::edit' => ['privates', '.service_locator.a8_8NHO', 'get_ServiceLocator_A88NHOService', true],
            'App\\Controller\\Back\\ItemController::index' => ['privates', '.service_locator.wCNelc_', 'get_ServiceLocator_WCNelcService', true],
            'App\\Controller\\Back\\ItemController::new' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\Back\\ItemController::show' => ['privates', '.service_locator.j4pAXxd', 'get_ServiceLocator_J4pAXxdService', true],
            'App\\Controller\\Back\\TripController::delete' => ['privates', '.service_locator.4H83jre', 'get_ServiceLocator_4H83jreService', true],
            'App\\Controller\\Back\\TripController::edit' => ['privates', '.service_locator.4H83jre', 'get_ServiceLocator_4H83jreService', true],
            'App\\Controller\\Back\\TripController::index' => ['privates', '.service_locator.QEvFhYA', 'get_ServiceLocator_QEvFhYAService', true],
            'App\\Controller\\Back\\TripController::new' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\Back\\TripController::show' => ['privates', '.service_locator.hwbBDlG', 'get_ServiceLocator_HwbBDlGService', true],
            'App\\Controller\\Back\\UserController::delete' => ['privates', '.service_locator.rvMNZGh', 'get_ServiceLocator_RvMNZGhService', true],
            'App\\Controller\\Back\\UserController::edit' => ['privates', '.service_locator.rvMNZGh', 'get_ServiceLocator_RvMNZGhService', true],
            'App\\Controller\\Back\\UserController::index' => ['privates', '.service_locator.kPUOGb8', 'get_ServiceLocator_KPUOGb8Service', true],
            'App\\Controller\\Back\\UserController::new' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\Back\\UserController::show' => ['privates', '.service_locator.Hz5btge', 'get_ServiceLocator_Hz5btgeService', true],
            'App\\Controller\\Back\\VoteController::delete' => ['privates', '.service_locator.pzYdd46', 'get_ServiceLocator_PzYdd46Service', true],
            'App\\Controller\\Back\\VoteController::edit' => ['privates', '.service_locator.pzYdd46', 'get_ServiceLocator_PzYdd46Service', true],
            'App\\Controller\\Back\\VoteController::index' => ['privates', '.service_locator.ZspBSxN', 'get_ServiceLocator_ZspBSxNService', true],
            'App\\Controller\\Back\\VoteController::new' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\Back\\VoteController::show' => ['privates', '.service_locator.a_Sg33a', 'get_ServiceLocator_ASg33aService', true],
            'App\\Controller\\SecurityController::login' => ['privates', '.service_locator.rSTd.nA', 'get_ServiceLocator_RSTd_NAService', true],
            'App\\Kernel::loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\Kernel::registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel::loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel::registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\Controller\\Api\\ActivityController:add' => ['privates', '.service_locator.wqezqEJ', 'get_ServiceLocator_WqezqEJService', true],
            'App\\Controller\\Api\\ActivityController:addTag' => ['privates', '.service_locator.I2EF6XW', 'get_ServiceLocator_I2EF6XWService', true],
            'App\\Controller\\Api\\ActivityController:browseByTrip' => ['privates', '.service_locator.S_M4X.a', 'get_ServiceLocator_SM4X_AService', true],
            'App\\Controller\\Api\\ActivityController:browseByTripThenCity' => ['privates', '.service_locator.Wy5MKOG', 'get_ServiceLocator_Wy5MKOGService', true],
            'App\\Controller\\Api\\ActivityController:browseByTripThenCityThenTag' => ['privates', '.service_locator.0VsW5S3', 'get_ServiceLocator_0VsW5S3Service', true],
            'App\\Controller\\Api\\ActivityController:browseByTripThenDay' => ['privates', '.service_locator.94OwKQV', 'get_ServiceLocator_94OwKQVService', true],
            'App\\Controller\\Api\\ActivityController:browseByTripThenDayThenTag' => ['privates', '.service_locator.ej2iIvb', 'get_ServiceLocator_Ej2iIvbService', true],
            'App\\Controller\\Api\\ActivityController:browseByTripThenTag' => ['privates', '.service_locator.8vCQfZ.', 'get_ServiceLocator_8vCQfZ_Service', true],
            'App\\Controller\\Api\\ActivityController:delete' => ['privates', '.service_locator.ZzEIOBS', 'get_ServiceLocator_ZzEIOBSService', true],
            'App\\Controller\\Api\\ActivityController:edit' => ['privates', '.service_locator._8ReKT7', 'get_ServiceLocator_8ReKT7Service', true],
            'App\\Controller\\Api\\ActivityController:read' => ['privates', '.service_locator.bDMu.SW', 'get_ServiceLocator_BDMu_SWService', true],
            'App\\Controller\\Api\\ActivityController:removeTag' => ['privates', '.service_locator.I2EF6XW', 'get_ServiceLocator_I2EF6XWService', true],
            'App\\Controller\\Api\\CityController:browse' => ['privates', '.service_locator.mkff3Zb', 'get_ServiceLocator_Mkff3ZbService', true],
            'App\\Controller\\Api\\CityController:read' => ['privates', '.service_locator.ycxdVNz', 'get_ServiceLocator_YcxdVNzService', true],
            'App\\Controller\\Api\\CountryController:addAvatar' => ['privates', '.service_locator.uZuct7W', 'get_ServiceLocator_UZuct7WService', true],
            'App\\Controller\\Api\\CountryController:browse' => ['privates', '.service_locator.2goNfau', 'get_ServiceLocator_2goNfauService', true],
            'App\\Controller\\Api\\CountryController:browseByCountry' => ['privates', '.service_locator.CvcttIg', 'get_ServiceLocator_CvcttIgService', true],
            'App\\Controller\\Api\\CountryController:deleteAvatar' => ['privates', '.service_locator.uZuct7W', 'get_ServiceLocator_UZuct7WService', true],
            'App\\Controller\\Api\\FriendController:add' => ['privates', '.service_locator.7m.qcGn', 'get_ServiceLocator_7m_QcGnService', true],
            'App\\Controller\\Api\\FriendController:delete' => ['privates', '.service_locator.gajgELK', 'get_ServiceLocator_GajgELKService', true],
            'App\\Controller\\Api\\FriendController:edit' => ['privates', '.service_locator.gajgELK', 'get_ServiceLocator_GajgELKService', true],
            'App\\Controller\\Api\\ItemController:add' => ['privates', '.service_locator.jPH4SbM', 'get_ServiceLocator_JPH4SbMService', true],
            'App\\Controller\\Api\\ItemController:browseBySuitcase' => ['privates', '.service_locator..ePpOA0', 'get_ServiceLocator__EPpOA0Service', true],
            'App\\Controller\\Api\\ItemController:delete' => ['privates', '.service_locator.KQbHgo6', 'get_ServiceLocator_KQbHgo6Service', true],
            'App\\Controller\\Api\\ItemController:edit' => ['privates', '.service_locator.Hc4Kh14', 'get_ServiceLocator_Hc4Kh14Service', true],
            'App\\Controller\\Api\\TripController:add' => ['privates', '.service_locator.jYQR168', 'get_ServiceLocator_JYQR168Service', true],
            'App\\Controller\\Api\\TripController:addCity' => ['privates', '.service_locator.qFLMMyM', 'get_ServiceLocator_QFLMMyMService', true],
            'App\\Controller\\Api\\TripController:addPicture' => ['privates', '.service_locator.3kZFhbf', 'get_ServiceLocator_3kZFhbfService', true],
            'App\\Controller\\Api\\TripController:addTraveler' => ['privates', '.service_locator.nhWMSMU', 'get_ServiceLocator_NhWMSMUService', true],
            'App\\Controller\\Api\\TripController:delete' => ['privates', '.service_locator.OrqEcoY', 'get_ServiceLocator_OrqEcoYService', true],
            'App\\Controller\\Api\\TripController:deletePicture' => ['privates', '.service_locator.3kZFhbf', 'get_ServiceLocator_3kZFhbfService', true],
            'App\\Controller\\Api\\TripController:edit' => ['privates', '.service_locator.sxTVA_v', 'get_ServiceLocator_SxTVAVService', true],
            'App\\Controller\\Api\\TripController:leaveTrip' => ['privates', '.service_locator.3m.cxc7', 'get_ServiceLocator_3m_Cxc7Service', true],
            'App\\Controller\\Api\\TripController:read' => ['privates', '.service_locator.S_M4X.a', 'get_ServiceLocator_SM4X_AService', true],
            'App\\Controller\\Api\\TripController:removeCity' => ['privates', '.service_locator.X4KLEsU', 'get_ServiceLocator_X4KLEsUService', true],
            'App\\Controller\\Api\\TripController:removeTraveler' => ['privates', '.service_locator.UFJqWKI', 'get_ServiceLocator_UFJqWKIService', true],
            'App\\Controller\\Api\\TripController:showTravelers' => ['privates', '.service_locator.S_M4X.a', 'get_ServiceLocator_SM4X_AService', true],
            'App\\Controller\\Api\\UserController:add' => ['privates', '.service_locator.u7Urtal', 'get_ServiceLocator_U7UrtalService', true],
            'App\\Controller\\Api\\UserController:addAvatar' => ['privates', '.service_locator.RWvOErq', 'get_ServiceLocator_RWvOErqService', true],
            'App\\Controller\\Api\\UserController:delete' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\Api\\UserController:deleteAvatar' => ['privates', '.service_locator.RWvOErq', 'get_ServiceLocator_RWvOErqService', true],
            'App\\Controller\\Api\\UserController:edit' => ['privates', '.service_locator.88sPeAh', 'get_ServiceLocator_88sPeAhService', true],
            'App\\Controller\\Api\\UserController:searchUser' => ['privates', '.service_locator.kPUOGb8', 'get_ServiceLocator_KPUOGb8Service', true],
            'App\\Controller\\Api\\VoteController:add' => ['privates', '.service_locator.WGKkuxh', 'get_ServiceLocator_WGKkuxhService', true],
            'App\\Controller\\Api\\VoteController:delete' => ['privates', '.service_locator.8SvkcYF', 'get_ServiceLocator_8SvkcYFService', true],
            'App\\Controller\\Api\\VoteController:read' => ['privates', '.service_locator.bDMu.SW', 'get_ServiceLocator_BDMu_SWService', true],
            'App\\Controller\\Back\\ActivityController:delete' => ['privates', '.service_locator.tXjO4lr', 'get_ServiceLocator_TXjO4lrService', true],
            'App\\Controller\\Back\\ActivityController:edit' => ['privates', '.service_locator.tXjO4lr', 'get_ServiceLocator_TXjO4lrService', true],
            'App\\Controller\\Back\\ActivityController:index' => ['privates', '.service_locator.eRk71wc', 'get_ServiceLocator_ERk71wcService', true],
            'App\\Controller\\Back\\ActivityController:new' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\Back\\ActivityController:show' => ['privates', '.service_locator.fvysUnv', 'get_ServiceLocator_FvysUnvService', true],
            'App\\Controller\\Back\\CityController:delete' => ['privates', '.service_locator.jyxuf8o', 'get_ServiceLocator_Jyxuf8oService', true],
            'App\\Controller\\Back\\CityController:edit' => ['privates', '.service_locator.jyxuf8o', 'get_ServiceLocator_Jyxuf8oService', true],
            'App\\Controller\\Back\\CityController:index' => ['privates', '.service_locator.mkff3Zb', 'get_ServiceLocator_Mkff3ZbService', true],
            'App\\Controller\\Back\\CityController:new' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\Back\\CityController:show' => ['privates', '.service_locator.ycxdVNz', 'get_ServiceLocator_YcxdVNzService', true],
            'App\\Controller\\Back\\CountryController:delete' => ['privates', '.service_locator.cDqCNLH', 'get_ServiceLocator_CDqCNLHService', true],
            'App\\Controller\\Back\\CountryController:edit' => ['privates', '.service_locator.cDqCNLH', 'get_ServiceLocator_CDqCNLHService', true],
            'App\\Controller\\Back\\CountryController:index' => ['privates', '.service_locator.2goNfau', 'get_ServiceLocator_2goNfauService', true],
            'App\\Controller\\Back\\CountryController:new' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\Back\\CountryController:show' => ['privates', '.service_locator.CvcttIg', 'get_ServiceLocator_CvcttIgService', true],
            'App\\Controller\\Back\\FriendController:delete' => ['privates', '.service_locator.y8qz20B', 'get_ServiceLocator_Y8qz20BService', true],
            'App\\Controller\\Back\\FriendController:edit' => ['privates', '.service_locator.y8qz20B', 'get_ServiceLocator_Y8qz20BService', true],
            'App\\Controller\\Back\\FriendController:index' => ['privates', '.service_locator.9lTe6Db', 'get_ServiceLocator_9lTe6DbService', true],
            'App\\Controller\\Back\\FriendController:new' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\Back\\FriendController:show' => ['privates', '.service_locator.avfua8H', 'get_ServiceLocator_Avfua8HService', true],
            'App\\Controller\\Back\\ItemController:delete' => ['privates', '.service_locator.a8_8NHO', 'get_ServiceLocator_A88NHOService', true],
            'App\\Controller\\Back\\ItemController:edit' => ['privates', '.service_locator.a8_8NHO', 'get_ServiceLocator_A88NHOService', true],
            'App\\Controller\\Back\\ItemController:index' => ['privates', '.service_locator.wCNelc_', 'get_ServiceLocator_WCNelcService', true],
            'App\\Controller\\Back\\ItemController:new' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\Back\\ItemController:show' => ['privates', '.service_locator.j4pAXxd', 'get_ServiceLocator_J4pAXxdService', true],
            'App\\Controller\\Back\\TripController:delete' => ['privates', '.service_locator.4H83jre', 'get_ServiceLocator_4H83jreService', true],
            'App\\Controller\\Back\\TripController:edit' => ['privates', '.service_locator.4H83jre', 'get_ServiceLocator_4H83jreService', true],
            'App\\Controller\\Back\\TripController:index' => ['privates', '.service_locator.QEvFhYA', 'get_ServiceLocator_QEvFhYAService', true],
            'App\\Controller\\Back\\TripController:new' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\Back\\TripController:show' => ['privates', '.service_locator.hwbBDlG', 'get_ServiceLocator_HwbBDlGService', true],
            'App\\Controller\\Back\\UserController:delete' => ['privates', '.service_locator.rvMNZGh', 'get_ServiceLocator_RvMNZGhService', true],
            'App\\Controller\\Back\\UserController:edit' => ['privates', '.service_locator.rvMNZGh', 'get_ServiceLocator_RvMNZGhService', true],
            'App\\Controller\\Back\\UserController:index' => ['privates', '.service_locator.kPUOGb8', 'get_ServiceLocator_KPUOGb8Service', true],
            'App\\Controller\\Back\\UserController:new' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\Back\\UserController:show' => ['privates', '.service_locator.Hz5btge', 'get_ServiceLocator_Hz5btgeService', true],
            'App\\Controller\\Back\\VoteController:delete' => ['privates', '.service_locator.pzYdd46', 'get_ServiceLocator_PzYdd46Service', true],
            'App\\Controller\\Back\\VoteController:edit' => ['privates', '.service_locator.pzYdd46', 'get_ServiceLocator_PzYdd46Service', true],
            'App\\Controller\\Back\\VoteController:index' => ['privates', '.service_locator.ZspBSxN', 'get_ServiceLocator_ZspBSxNService', true],
            'App\\Controller\\Back\\VoteController:new' => ['privates', '.service_locator.CsMkqUa', 'get_ServiceLocator_CsMkqUaService', true],
            'App\\Controller\\Back\\VoteController:show' => ['privates', '.service_locator.a_Sg33a', 'get_ServiceLocator_ASg33aService', true],
            'App\\Controller\\SecurityController:login' => ['privates', '.service_locator.rSTd.nA', 'get_ServiceLocator_RSTd_NAService', true],
            'kernel:loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel:registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
        ], [
            'App\\Controller\\Api\\ActivityController::add' => '?',
            'App\\Controller\\Api\\ActivityController::addTag' => '?',
            'App\\Controller\\Api\\ActivityController::browseByTrip' => '?',
            'App\\Controller\\Api\\ActivityController::browseByTripThenCity' => '?',
            'App\\Controller\\Api\\ActivityController::browseByTripThenCityThenTag' => '?',
            'App\\Controller\\Api\\ActivityController::browseByTripThenDay' => '?',
            'App\\Controller\\Api\\ActivityController::browseByTripThenDayThenTag' => '?',
            'App\\Controller\\Api\\ActivityController::browseByTripThenTag' => '?',
            'App\\Controller\\Api\\ActivityController::delete' => '?',
            'App\\Controller\\Api\\ActivityController::edit' => '?',
            'App\\Controller\\Api\\ActivityController::read' => '?',
            'App\\Controller\\Api\\ActivityController::removeTag' => '?',
            'App\\Controller\\Api\\CityController::browse' => '?',
            'App\\Controller\\Api\\CityController::read' => '?',
            'App\\Controller\\Api\\CountryController::addAvatar' => '?',
            'App\\Controller\\Api\\CountryController::browse' => '?',
            'App\\Controller\\Api\\CountryController::browseByCountry' => '?',
            'App\\Controller\\Api\\CountryController::deleteAvatar' => '?',
            'App\\Controller\\Api\\FriendController::add' => '?',
            'App\\Controller\\Api\\FriendController::delete' => '?',
            'App\\Controller\\Api\\FriendController::edit' => '?',
            'App\\Controller\\Api\\ItemController::add' => '?',
            'App\\Controller\\Api\\ItemController::browseBySuitcase' => '?',
            'App\\Controller\\Api\\ItemController::delete' => '?',
            'App\\Controller\\Api\\ItemController::edit' => '?',
            'App\\Controller\\Api\\TripController::add' => '?',
            'App\\Controller\\Api\\TripController::addCity' => '?',
            'App\\Controller\\Api\\TripController::addPicture' => '?',
            'App\\Controller\\Api\\TripController::addTraveler' => '?',
            'App\\Controller\\Api\\TripController::delete' => '?',
            'App\\Controller\\Api\\TripController::deletePicture' => '?',
            'App\\Controller\\Api\\TripController::edit' => '?',
            'App\\Controller\\Api\\TripController::leaveTrip' => '?',
            'App\\Controller\\Api\\TripController::read' => '?',
            'App\\Controller\\Api\\TripController::removeCity' => '?',
            'App\\Controller\\Api\\TripController::removeTraveler' => '?',
            'App\\Controller\\Api\\TripController::showTravelers' => '?',
            'App\\Controller\\Api\\UserController::add' => '?',
            'App\\Controller\\Api\\UserController::addAvatar' => '?',
            'App\\Controller\\Api\\UserController::delete' => '?',
            'App\\Controller\\Api\\UserController::deleteAvatar' => '?',
            'App\\Controller\\Api\\UserController::edit' => '?',
            'App\\Controller\\Api\\UserController::searchUser' => '?',
            'App\\Controller\\Api\\VoteController::add' => '?',
            'App\\Controller\\Api\\VoteController::delete' => '?',
            'App\\Controller\\Api\\VoteController::read' => '?',
            'App\\Controller\\Back\\ActivityController::delete' => '?',
            'App\\Controller\\Back\\ActivityController::edit' => '?',
            'App\\Controller\\Back\\ActivityController::index' => '?',
            'App\\Controller\\Back\\ActivityController::new' => '?',
            'App\\Controller\\Back\\ActivityController::show' => '?',
            'App\\Controller\\Back\\CityController::delete' => '?',
            'App\\Controller\\Back\\CityController::edit' => '?',
            'App\\Controller\\Back\\CityController::index' => '?',
            'App\\Controller\\Back\\CityController::new' => '?',
            'App\\Controller\\Back\\CityController::show' => '?',
            'App\\Controller\\Back\\CountryController::delete' => '?',
            'App\\Controller\\Back\\CountryController::edit' => '?',
            'App\\Controller\\Back\\CountryController::index' => '?',
            'App\\Controller\\Back\\CountryController::new' => '?',
            'App\\Controller\\Back\\CountryController::show' => '?',
            'App\\Controller\\Back\\FriendController::delete' => '?',
            'App\\Controller\\Back\\FriendController::edit' => '?',
            'App\\Controller\\Back\\FriendController::index' => '?',
            'App\\Controller\\Back\\FriendController::new' => '?',
            'App\\Controller\\Back\\FriendController::show' => '?',
            'App\\Controller\\Back\\ItemController::delete' => '?',
            'App\\Controller\\Back\\ItemController::edit' => '?',
            'App\\Controller\\Back\\ItemController::index' => '?',
            'App\\Controller\\Back\\ItemController::new' => '?',
            'App\\Controller\\Back\\ItemController::show' => '?',
            'App\\Controller\\Back\\TripController::delete' => '?',
            'App\\Controller\\Back\\TripController::edit' => '?',
            'App\\Controller\\Back\\TripController::index' => '?',
            'App\\Controller\\Back\\TripController::new' => '?',
            'App\\Controller\\Back\\TripController::show' => '?',
            'App\\Controller\\Back\\UserController::delete' => '?',
            'App\\Controller\\Back\\UserController::edit' => '?',
            'App\\Controller\\Back\\UserController::index' => '?',
            'App\\Controller\\Back\\UserController::new' => '?',
            'App\\Controller\\Back\\UserController::show' => '?',
            'App\\Controller\\Back\\VoteController::delete' => '?',
            'App\\Controller\\Back\\VoteController::edit' => '?',
            'App\\Controller\\Back\\VoteController::index' => '?',
            'App\\Controller\\Back\\VoteController::new' => '?',
            'App\\Controller\\Back\\VoteController::show' => '?',
            'App\\Controller\\SecurityController::login' => '?',
            'App\\Kernel::loadRoutes' => '?',
            'App\\Kernel::registerContainerConfiguration' => '?',
            'kernel::loadRoutes' => '?',
            'kernel::registerContainerConfiguration' => '?',
            'App\\Controller\\Api\\ActivityController:add' => '?',
            'App\\Controller\\Api\\ActivityController:addTag' => '?',
            'App\\Controller\\Api\\ActivityController:browseByTrip' => '?',
            'App\\Controller\\Api\\ActivityController:browseByTripThenCity' => '?',
            'App\\Controller\\Api\\ActivityController:browseByTripThenCityThenTag' => '?',
            'App\\Controller\\Api\\ActivityController:browseByTripThenDay' => '?',
            'App\\Controller\\Api\\ActivityController:browseByTripThenDayThenTag' => '?',
            'App\\Controller\\Api\\ActivityController:browseByTripThenTag' => '?',
            'App\\Controller\\Api\\ActivityController:delete' => '?',
            'App\\Controller\\Api\\ActivityController:edit' => '?',
            'App\\Controller\\Api\\ActivityController:read' => '?',
            'App\\Controller\\Api\\ActivityController:removeTag' => '?',
            'App\\Controller\\Api\\CityController:browse' => '?',
            'App\\Controller\\Api\\CityController:read' => '?',
            'App\\Controller\\Api\\CountryController:addAvatar' => '?',
            'App\\Controller\\Api\\CountryController:browse' => '?',
            'App\\Controller\\Api\\CountryController:browseByCountry' => '?',
            'App\\Controller\\Api\\CountryController:deleteAvatar' => '?',
            'App\\Controller\\Api\\FriendController:add' => '?',
            'App\\Controller\\Api\\FriendController:delete' => '?',
            'App\\Controller\\Api\\FriendController:edit' => '?',
            'App\\Controller\\Api\\ItemController:add' => '?',
            'App\\Controller\\Api\\ItemController:browseBySuitcase' => '?',
            'App\\Controller\\Api\\ItemController:delete' => '?',
            'App\\Controller\\Api\\ItemController:edit' => '?',
            'App\\Controller\\Api\\TripController:add' => '?',
            'App\\Controller\\Api\\TripController:addCity' => '?',
            'App\\Controller\\Api\\TripController:addPicture' => '?',
            'App\\Controller\\Api\\TripController:addTraveler' => '?',
            'App\\Controller\\Api\\TripController:delete' => '?',
            'App\\Controller\\Api\\TripController:deletePicture' => '?',
            'App\\Controller\\Api\\TripController:edit' => '?',
            'App\\Controller\\Api\\TripController:leaveTrip' => '?',
            'App\\Controller\\Api\\TripController:read' => '?',
            'App\\Controller\\Api\\TripController:removeCity' => '?',
            'App\\Controller\\Api\\TripController:removeTraveler' => '?',
            'App\\Controller\\Api\\TripController:showTravelers' => '?',
            'App\\Controller\\Api\\UserController:add' => '?',
            'App\\Controller\\Api\\UserController:addAvatar' => '?',
            'App\\Controller\\Api\\UserController:delete' => '?',
            'App\\Controller\\Api\\UserController:deleteAvatar' => '?',
            'App\\Controller\\Api\\UserController:edit' => '?',
            'App\\Controller\\Api\\UserController:searchUser' => '?',
            'App\\Controller\\Api\\VoteController:add' => '?',
            'App\\Controller\\Api\\VoteController:delete' => '?',
            'App\\Controller\\Api\\VoteController:read' => '?',
            'App\\Controller\\Back\\ActivityController:delete' => '?',
            'App\\Controller\\Back\\ActivityController:edit' => '?',
            'App\\Controller\\Back\\ActivityController:index' => '?',
            'App\\Controller\\Back\\ActivityController:new' => '?',
            'App\\Controller\\Back\\ActivityController:show' => '?',
            'App\\Controller\\Back\\CityController:delete' => '?',
            'App\\Controller\\Back\\CityController:edit' => '?',
            'App\\Controller\\Back\\CityController:index' => '?',
            'App\\Controller\\Back\\CityController:new' => '?',
            'App\\Controller\\Back\\CityController:show' => '?',
            'App\\Controller\\Back\\CountryController:delete' => '?',
            'App\\Controller\\Back\\CountryController:edit' => '?',
            'App\\Controller\\Back\\CountryController:index' => '?',
            'App\\Controller\\Back\\CountryController:new' => '?',
            'App\\Controller\\Back\\CountryController:show' => '?',
            'App\\Controller\\Back\\FriendController:delete' => '?',
            'App\\Controller\\Back\\FriendController:edit' => '?',
            'App\\Controller\\Back\\FriendController:index' => '?',
            'App\\Controller\\Back\\FriendController:new' => '?',
            'App\\Controller\\Back\\FriendController:show' => '?',
            'App\\Controller\\Back\\ItemController:delete' => '?',
            'App\\Controller\\Back\\ItemController:edit' => '?',
            'App\\Controller\\Back\\ItemController:index' => '?',
            'App\\Controller\\Back\\ItemController:new' => '?',
            'App\\Controller\\Back\\ItemController:show' => '?',
            'App\\Controller\\Back\\TripController:delete' => '?',
            'App\\Controller\\Back\\TripController:edit' => '?',
            'App\\Controller\\Back\\TripController:index' => '?',
            'App\\Controller\\Back\\TripController:new' => '?',
            'App\\Controller\\Back\\TripController:show' => '?',
            'App\\Controller\\Back\\UserController:delete' => '?',
            'App\\Controller\\Back\\UserController:edit' => '?',
            'App\\Controller\\Back\\UserController:index' => '?',
            'App\\Controller\\Back\\UserController:new' => '?',
            'App\\Controller\\Back\\UserController:show' => '?',
            'App\\Controller\\Back\\VoteController:delete' => '?',
            'App\\Controller\\Back\\VoteController:edit' => '?',
            'App\\Controller\\Back\\VoteController:index' => '?',
            'App\\Controller\\Back\\VoteController:new' => '?',
            'App\\Controller\\Back\\VoteController:show' => '?',
            'App\\Controller\\SecurityController:login' => '?',
            'kernel:loadRoutes' => '?',
            'kernel:registerContainerConfiguration' => '?',
        ]);
    }
}
