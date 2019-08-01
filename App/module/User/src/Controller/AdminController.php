<?php
namespace User\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use User\Entity\DefaultConfiguration;
use \Exception;

class AdminController extends AbstractActionController
{
	private $entityManager;
	private $defaultConfigurationRepo;

	public function __construct($entityManager)
	{
		$this->entityManager = $entityManager;
		$this->defaultConfigurationRepo = $this->entityManager->getRepository(DefaultConfiguration::class);
	}

	public function indexAction()
	{
		if(!$this->auth()->isAdmin())
		{
			$this->flashMessenger()->addErrorMessage("You Donot have permission to view this page");
			return $this->redirect()->toRoute('index');
		}

	}

	public function settingAction()
	{
		if(!$this->auth()->hasIdentity())
		{
	 		return $this->redirect()->toRoute('login');

		}
		if(!$this->auth()->isAdmin())
	 	{
	 		$this->flashMessenger()->addErrorMessage("You dont Have permission to view that page");
	 		return $this->redirect()->toRoute('dashboard');
	 	}

		return new ViewModel(['defaultConfigurationRepo' => $this->defaultConfigurationRepo]);
	}
	 public function defaultUserTypeAction()
	 {
	 	if(!$this->auth()->isAdmin())
	 	{
	 		$this->flashMessenger()->addErrorMessage("You dont Have permission to view that page");
	 		return $this->redirect()->toRoute('dashboard');
	 	}
	 	try
	 	{
	 		$defaultUserType =  $this->defaultConfigurationRepo->findOneBy(['optionName' => 'default_user']);

		 	if($this->getRequest()->isPost())
		 	{
		 		$optionValue = $this->params()->fromPost('default_user_type');

		 		if($optionValue == $defaultUserType->getOptionValueOne() || $optionValue == $defaultUserType->getOptionValueTwo())
		 		{
		 			$defaultUserType->setOptionValue($optionValue);
		 			$this->entityManager->persist($defaultUserType);
		 			$this->entityManager->flush();
		 			$this->flashMessenger()->addSuccessMessage('Settings Updated');
		 			return $this->redirect()->toRoute('admin/setting');
		 		}
		 		$this->flashMessenger()->addErrorMessage('The Entered Value is Not correct');
		 		return $this->redirect()->toRoute('admin/setting/default-user-type');	
		 	}


	 	}catch(Exception $e)
	 	{
	 		$this->flashMessenger()->addErrorMessage($e->getMessage());
	 		return $this->redirect()->toRoute('admin/setting');

	 	}
	 	

	 	return new ViewModel(['defaultUserType' => $defaultUserType]);
	 	 
	 }

	 
}