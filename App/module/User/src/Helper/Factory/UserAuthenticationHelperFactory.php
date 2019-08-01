<?php
namespace User\Helper\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use User\Helper\UserAuthenticationHelper;
use User\Plugin\UserAuthenticationPlugin;

class UserAuthenticationHelperFactory implements FactoryInterface
{

	 public function __invoke(ContainerInterface $container, $requestedName, array $options = null) 
     {
     	$authControllerPlugin = $container->get(UserAuthenticationPlugin::class);
     	$entityManager = $container->get('doctrine.entitymanager.orm_default');
     	return new UserAuthenticationHelper($authControllerPlugin , $entityManager);

     }





       

}