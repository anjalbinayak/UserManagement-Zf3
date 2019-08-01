<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

/**
 * List of enabled modules for this application.
 *
 * This should be an array of module namespaces used in the application.
 */
return [
    'Zend\Db',
    'Zend\ServiceManager\Di',
    'Zend\Navigation',
    'Zend\Mvc\Plugin\FilePrg',
    'Zend\Mvc\Plugin\FlashMessenger',
    'Zend\Mvc\Plugin\Identity',
    'Zend\Mvc\Plugin\Prg',
    'Zend\Session',
    'Zend\Mvc\I18n',
    'Zend\I18n',
    'Zend\Mail',
    'Zend\Log',
    'Zend\Cache',
    'Zend\InputFilter',
    'Zend\Filter',
    'Zend\Paginator',
    'Zend\Hydrator',
    'Zend\Router',
    'Zend\Validator',
    'Zend\Form',
    'DoctrineModule',
	'DoctrineORMModule',
    'Application',
    'User',
    'AuthManager',
];
