<?php
namespace User\Plugin\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use User\Plugin\UserAuthenticationPlugin;
use Zend\Authentication\AuthenticationService;

class UserAuthenticationPluginFactory implements FactoryInterface
{

	 public function __invoke(ContainerInterface $container, $requestedName, array $options = null) 
     {
     	$authService = $container->get(AuthenticationService::class);
     	$entityManager = $container->get('doctrine.entitymanager.orm_default');
     	return new UserAuthenticationPlugin($authService , $entityManager);

     }





       

}