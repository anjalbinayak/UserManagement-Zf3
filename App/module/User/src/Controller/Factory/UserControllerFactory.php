<?php 
namespace User\Controller\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use User\Entity\User;
use User\Controller\UserController;
use Interop\Container\ContainerInterface;
use User\Service\UserService;
use User\Service\SignupService;



// Factory class
class UserControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, 
                     $requestedName, array $options = null) 
    {
        // Get the instance of CurrencyConverter service from the service manager.
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
      
        $userService = $container->get(UserService::class);

       
       
        
        // Create an instance of the controller and pass the dependency 
        // to controller's constructor.
        return new UserController($entityManager , $userService);	
    }
}
