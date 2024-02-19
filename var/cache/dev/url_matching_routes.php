<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/api/login_check' => [[['_route' => 'api_login_check'], null, null, null, false, false, null]],
        '/api/city' => [[['_route' => 'api_city_browse', '_controller' => 'App\\Controller\\Api\\CityController::browse'], null, ['GET' => 0], null, true, false, null]],
        '/api/country' => [[['_route' => 'api_country_browse', '_controller' => 'App\\Controller\\Api\\CountryController::browse'], null, ['GET' => 0], null, true, false, null]],
        '/api/friend' => [[['_route' => 'api_user_read', '_controller' => 'App\\Controller\\Api\\FriendController::read'], null, ['GET' => 0], null, true, false, null]],
        '/api/mytrips' => [[['_route' => 'api_trip_user', '_controller' => 'App\\Controller\\Api\\TripController::browseByUser'], null, ['GET' => 0], null, false, false, null]],
        '/api/trip/add' => [[['_route' => 'api_trip_new', '_controller' => 'App\\Controller\\Api\\TripController::add'], null, ['POST' => 0], null, false, false, null]],
        '/api/user/all' => [[['_route' => 'api_user_browse', '_controller' => 'App\\Controller\\Api\\UserController::browse'], null, ['GET' => 0], null, false, false, null]],
        '/api/user/search' => [[['_route' => 'api_user_search', '_controller' => 'App\\Controller\\Api\\UserController::searchUser'], null, ['POST' => 0], null, false, false, null]],
        '/api/user/me' => [[['_route' => 'api_user_me', '_controller' => 'App\\Controller\\Api\\UserController::me'], null, ['GET' => 0], null, false, false, null]],
        '/api/user/me/add_avatar' => [[['_route' => 'api_user_add_avatar', '_controller' => 'App\\Controller\\Api\\UserController::addAvatar'], null, ['POST' => 0], null, false, false, null]],
        '/api/user/me/delete_avatar' => [[['_route' => 'api_user_delete_avatar', '_controller' => 'App\\Controller\\Api\\UserController::deleteAvatar'], null, ['POST' => 0], null, false, false, null]],
        '/api/user/add' => [[['_route' => 'api_user_add', '_controller' => 'App\\Controller\\Api\\UserController::add'], null, ['POST' => 0], null, false, false, null]],
        '/api/user/me/update' => [[['_route' => 'api_user_edit', '_controller' => 'App\\Controller\\Api\\UserController::edit'], null, ['PUT' => 0], null, false, false, null]],
        '/api/user/delete' => [[['_route' => 'api_user_delete', '_controller' => 'App\\Controller\\Api\\UserController::delete'], null, ['DELETE' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/(?'
                        .'|font/([^/\\.]++)\\.woff2(*:98)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:134)'
                                .'|router(*:148)'
                                .'|exception(?'
                                    .'|(*:168)'
                                    .'|\\.css(*:181)'
                                .')'
                            .')'
                            .'|(*:191)'
                        .')'
                    .')'
                .')'
                .'|/api/(?'
                    .'|trip/(?'
                        .'|(\\d+)/activities(*:234)'
                        .'|(\\d+)/activity/add(*:260)'
                        .'|([^/]++)/activities/cities(?:/([^/]++))?(*:308)'
                        .'|(\\d+)/activities/date(?:/(\\d{4}\\-\\d{2}\\-\\d{2}))?(*:364)'
                        .'|(\\d+)/activities/date/(\\d{4}\\-\\d{2}\\-\\d{2})/tags(?:/([^/]++))?(*:434)'
                        .'|(\\d+)/activities/city/([^/]++)/tags/([^/]++)(*:486)'
                        .'|(\\d+)(*:499)'
                        .'|([^/]++)/(?'
                            .'|add_picture(*:530)'
                            .'|delete_picture(*:552)'
                        .')'
                        .'|(\\d+)(*:566)'
                        .'|(\\d+)/addTraveler(*:591)'
                        .'|(\\d+)(*:604)'
                        .'|(\\d+)/removeTraveler(*:632)'
                        .'|(\\d+)/showTravelers(*:659)'
                        .'|(\\d+)/leaveTrip(*:682)'
                    .')'
                    .'|activity/(\\d+)(?'
                        .'|(*:708)'
                    .')'
                    .'|c(?'
                        .'|ity/(\\d+)(*:730)'
                        .'|ountry/(?'
                            .'|(\\d+)/cities(*:760)'
                            .'|(\\d+)/add_picture(*:785)'
                            .'|(\\d+)/delete_picture(*:813)'
                        .')'
                    .')'
                    .'|friend/(\\d+)(*:835)'
                    .'|vote/(\\d+)(?'
                        .'|(*:856)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        98 => [[['_route' => '_profiler_font', '_controller' => 'web_profiler.controller.profiler::fontAction'], ['fontName'], null, null, false, false, null]],
        134 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        148 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        168 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        181 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        191 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        234 => [[['_route' => 'api_activity_browse_trip', '_controller' => 'App\\Controller\\Api\\ActivityController::browseByTrip'], ['id'], ['GET' => 0], null, true, false, null]],
        260 => [[['_route' => 'api_activity_post', '_controller' => 'App\\Controller\\Api\\ActivityController::add'], ['id'], ['POST' => 0], null, false, false, null]],
        308 => [[['_route' => 'api_activity_browse_tags', 'trip' => null, 'city' => null, '_controller' => 'App\\Controller\\Api\\ActivityController::browseByTripThenCity'], ['trip', 'city'], ['GET' => 0], null, false, true, null]],
        364 => [[['_route' => 'api_activity_browse_day', 'date' => null, '_controller' => 'App\\Controller\\Api\\ActivityController::browseByTripThenDay'], ['id', 'date'], ['GET' => 0], null, false, true, null]],
        434 => [[['_route' => 'api_activity_browse_day_tag', 'trip' => null, 'date' => null, 'tag' => null, '_controller' => 'App\\Controller\\Api\\ActivityController::browseByTripThenDayThenTag'], ['trip', 'date', 'tag'], ['GET' => 0], null, false, true, null]],
        486 => [[['_route' => 'api_activity_browse_city_tag', '_controller' => 'App\\Controller\\Api\\ActivityController::browseByTripThenCityThenTag'], ['trip', 'city', 'tag'], ['GET' => 0], null, false, true, null]],
        499 => [[['_route' => 'api_trip_read', '_controller' => 'App\\Controller\\Api\\TripController::read'], ['id'], ['GET' => 0], null, false, true, null]],
        530 => [[['_route' => 'api_trip_add_picture', '_controller' => 'App\\Controller\\Api\\TripController::addPicture'], ['id'], ['POST' => 0], null, false, false, null]],
        552 => [[['_route' => 'api_trip_delete_picture', '_controller' => 'App\\Controller\\Api\\TripController::deletePicture'], ['id'], ['POST' => 0], null, false, false, null]],
        566 => [[['_route' => 'api_trip_edit', '_controller' => 'App\\Controller\\Api\\TripController::edit'], ['id'], ['PUT' => 0], null, false, true, null]],
        591 => [[['_route' => 'api_trip_add_traveler', '_controller' => 'App\\Controller\\Api\\TripController::addTraveler'], ['id'], ['PUT' => 0], null, false, false, null]],
        604 => [[['_route' => 'api_trip_delete', '_controller' => 'App\\Controller\\Api\\TripController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        632 => [[['_route' => 'api_trip_remove_traveler', '_controller' => 'App\\Controller\\Api\\TripController::removeTraveler'], ['id'], ['DELETE' => 0], null, false, false, null]],
        659 => [[['_route' => 'api_trip_show_travelers', '_controller' => 'App\\Controller\\Api\\TripController::showTravelers'], ['id'], ['GET' => 0], null, false, false, null]],
        682 => [[['_route' => 'api_trip_leave_trip', '_controller' => 'App\\Controller\\Api\\TripController::leaveTrip'], ['id'], ['DELETE' => 0], null, false, false, null]],
        708 => [
            [['_route' => 'api_activity_read', '_controller' => 'App\\Controller\\Api\\ActivityController::read'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_activity_edit', '_controller' => 'App\\Controller\\Api\\ActivityController::edit'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'api_activity_delete', '_controller' => 'App\\Controller\\Api\\ActivityController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        730 => [[['_route' => 'api_city_read', '_controller' => 'App\\Controller\\Api\\CityController::read'], ['id'], ['GET' => 0], null, false, true, null]],
        760 => [[['_route' => 'api_country_read', '_controller' => 'App\\Controller\\Api\\CountryController::browseByCountry'], ['id'], ['GET' => 0], null, false, false, null]],
        785 => [[['_route' => 'api_country_add_picture', '_controller' => 'App\\Controller\\Api\\CountryController::addAvatar'], ['id'], ['POST' => 0], null, false, false, null]],
        813 => [[['_route' => 'api_country_delete_picture', '_controller' => 'App\\Controller\\Api\\CountryController::deleteAvatar'], ['id'], ['POST' => 0], null, false, false, null]],
        835 => [[['_route' => 'api_user_post', '_controller' => 'App\\Controller\\Api\\FriendController::edit'], ['id'], ['PUT' => 0], null, false, true, null]],
        856 => [
            [['_route' => 'api_vote_activity_user_add', '_controller' => 'App\\Controller\\Api\\VoteController::add'], ['id'], ['POST' => 0], null, false, true, null],
            [['_route' => 'api_vote_activity_user_delete', '_controller' => 'App\\Controller\\Api\\VoteController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_vote_activity_user_read', '_controller' => 'App\\Controller\\Api\\VoteController::read'], ['id'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
