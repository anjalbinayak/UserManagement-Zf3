<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;


return [
    'router' => [
        'routes' => [
            'user' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/user',
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'new' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/new',
                            'defaults' => [
                                'controller' => Controller\UserController::class,
                                'action' => 'new'
                            ]
                        ]
                    ],
                    'view' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/view/:id',
                            'defaults' => [
                                'controller' => Controller\UserController::class,
                                'action' => 'view'
                            ]
                        ]
                    ],
                    'index' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/',
                            'defaults' => [
                                'controller' => Controller\UserController::class,
                                'action' => 'index'
                            ]
                        ]
                    ],
                    'disable' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/disable/:id',
                            'defaults' => [
                                'controller' => Controller\UserController::class,
                                'action' => 'disable'
                            ]
                        ]
                    ],
                     'enable' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/enable/:id',
                            'defaults' => [
                                'controller' => Controller\UserController::class,
                                'action' => 'enable'
                            ]
                        ]
                    ],
                       'edit' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/edit/:id',
                            'defaults' => [
                                'controller' => Controller\UserController::class,
                                'action' => 'edit'
                            ]
                        ]
                    ],

                ]
            ],
            'index' =>[
                'type' => Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller'=> Controller\IndexController::class,
                        'action' => 'index'
                    ]
                ]
            ],
            'dashboard' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/dashboard',
                    'defaults' => [
                        'controller' => Controller\DashboardController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' =>[
                    'index' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/',
                            'defaults' => [
                                'controller' => Controller\DashboardController::class,
                                'action' => 'index'
                            ]
                        ]
                    ],
                     'profile' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/profile',
                            'defaults' => [
                                'controller' => Controller\DashboardController::class,
                                'action' => 'profile'
                            ]
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'edit' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/edit',
                                    'defaults' => [
                                        'controller' => Controller\DashboardController::class,
                                        'action' => 'edit'
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'passwordChange' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/passwordChange',
                            'defaults' => [
                                'controller' => Controller\DashboardController::class,
                                'action' => 'passwordChange'
                            ]
                        ]
                    ],

                ]
            ],
            'admin' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/admin',
                    'defaults' => [
                        'controller' => Controller\AdminController::class,
                        'action' => 'index'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'setting' =>[
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/setting',
                            'defaults' => [
                                'controller' => Controller\AdminController::class,
                                'action' => 'setting'
                            ]
                        ]
                      
                    ],
                    'defaultUserType' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/setting/default-user-type',
                            'defaults' => [
                                'controller' => Controller\AdminController::class,
                                'action' => 'defaultUserType'
                            ]
                        ]
                    ],
                ]
            ],
            'login' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/login',
                    'defaults' => [
                        'controller' => Controller\LoginController::class,
                        'action' => 'index'
                    ]
                ]
            ],
            'logout' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/logout',
                    'defaults' => [
                        'controller' => Controller\LoginController::class,
                        'action' => 'logout'
                    ]
                ]
            ],
            'signup' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/signup',
                    'defaults' => [
                        'controller' => Controller\SignupController::class,
                        'action' => 'index'
                    ]
                ]
            ],
        ]
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\AdminController::class => Controller\Factory\AdminControllerFactory::class,
            Controller\UserController::class => Controller\Factory\UserControllerFactory::class,
            Controller\LoginController::class => Controller\Factory\LoginControllerFactory::class, 
            Controller\SignupController::class => Controller\Factory\SignupControllerFactory::class,
            Controller\DashboardController::class => Controller\Factory\DashboardControllerFactory::class
        ],
    ],
    'controller_plugins' => [
        'factories' => [
            Plugin\UserAuthenticationPlugin::class => Plugin\Factory\UserAuthenticationPluginFactory::class 
        ],
        'aliases' => [
            'auth' => Plugin\UserAuthenticationPlugin::class
        ]
    ],
    'view_helpers' => [
        'factories' => [
            Helper\UserAuthenticationHelper::class => Helper
            \Factory\UserAuthenticationHelperFactory::class
        ],
        'aliases' => [
            'auth' => Helper\UserAuthenticationHelper::class
        ]
    ],

    'service_manager' =>[
        'factories' =>[
            Plugin\UserAuthenticationPlugin::class => Plugin\Factory\UserAuthenticationPluginFactory::class,
            Service\SignupService::class => Service\Factory\SignupServiceFactory::class,
            Service\LoginService::class => Service\Factory\LoginServiceFactory::class,
            Service\UserService::class => Service\Factory\UserServiceFactory::class,
            Service\DashboardService::class => Service\Factory\DashboardServiceFactory::class,
            \AuthManager\Service\AdapterService::class => \AuthManager\Service\Factory\AdapterServiceFactory::class, 
            \Zend\Authentication\AuthenticationService::class => Service\Factory\AuthenticationServiceFactory::class,

        ]
    ],

    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],


    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'application/index/index' => __DIR__ . '/../view/user/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
