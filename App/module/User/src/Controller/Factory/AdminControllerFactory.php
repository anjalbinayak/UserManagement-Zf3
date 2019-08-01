<?php 
namespace User\Controller\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use User\Entity\User;
use User\Controller\AdminController;
use Interop\Container\ContainerInterface;

class AdminControllerFactory implements FactoryInterface
{
	 public function __invoke(ContainerInterface $container, 
                     $requestedName, array $options = null) 
       {
       
	        $entityManager = $container->get('doctrine.entitymanager.orm_default');
	        return new AdminController($entityManager);	
       }

}
