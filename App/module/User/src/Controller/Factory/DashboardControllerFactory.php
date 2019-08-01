<?php 
namespace User\Controller\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use User\Entity\User;
use User\Service\DashboardService;
use User\Service\UserService;
use User\Controller\DashboardController;
use Interop\Container\ContainerInterface;

class DashboardControllerFactory implements FactoryInterface
{
	 public function __invoke(ContainerInterface $container, 
                     $requestedName, array $options = null) 
       {
       
	        $entityManager = $container->get('doctrine.entitymanager.orm_default');
	      
	        $dashboardService = $container->get(DashboardService::class);

	        $userService = $container->get(UserService::class);
	       
	        
	    
	        return new DashboardController($entityManager , $dashboardService , $userService);	
       }

}
