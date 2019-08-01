<?php 
namespace User\Controller\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use User\Entity\User;
use User\Controller\SignupController;
use Interop\Container\ContainerInterface;
use User\Service\SignupService;

// Factory class
class SignupControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, 
                     $requestedName, array $options = null) 
    {
        
       $entityManager = $container->get('doctrine.entitymanager.orm_default');
       $signupService= $container->get(SignupService::class);
        
        
        return new SignupController($entityManager , $signupService);	
    }
}
