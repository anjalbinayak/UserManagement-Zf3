<?php 
namespace AuthManager\Service\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use AuthManager\Service\AdapterService;
use Interop\Container\ContainerInterface;

class AdapterServiceFactory implements FactoryInterface
{
	 public function __invoke(ContainerInterface $container, 
                     $requestedName, array $options = null) 
       {
       
	        $entityManager = $container->get('doctrine.entitymanager.orm_default');
	        return new AdapterService($entityManager);	
       }

}
