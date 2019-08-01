<?php 
namespace User\Controller\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use User\Entity\User;
use User\Controller\LoginController;
use Interop\Container\ContainerInterface;
use User\Service\LoginService;
use Zend\Authentication\AuthenticationService;
use AuthManager\Service\AdapterService;


// Factory class
class LoginControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, 
                     $requestedName, array $options = null) 
    {
        
       $entityManager = $container->get('doctrine.entitymanager.orm_default');
       $loginService= $container->get(LoginService::class);
       $authService = $container->get(AuthenticationService::class);
       $adapter = $container->get(AdapterService::class);
        
        
        return new LoginController($entityManager , $authService , $adapter);	
    }
}
