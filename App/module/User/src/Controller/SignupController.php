<?php
namespace User\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use User\Form\SignupForm;
use User\Entity\User;
use \Exception;


class SignupController extends AbstractActionController
{
	private $em;
	private $signupService;

	public function __construct($em, $signupService)
	{
		$this->em = $em;
		$this->signupService = $signupService;
	}

	public function indexAction()
	{
		try
		{
			
			$signupForm = new SignupForm();
				
			if($this->getRequest()->isPost())
				{ 

					$data= array_merge_recursive(

					$this->params()->fromPost(),
					$this->params()->fromFiles()
					);

					$signupForm->setData($data);
			 
			
					if ($signupForm->isValid()) {

		            	$data = $signupForm->getData();
		            	$this->signupService->setData($data);
		            	return $this->redirect()->toRoute('login');
   
	            	}
				}
		

		}catch(Exception $e)
		{
			$this->flashMessenger()->addErrorMessage($e->getMessage());
			return $this->redirect()->toRoute('signup');
		}
		
		$viewModel = new ViewModel([
			'signupForm' => $signupForm,
			
		]
		);
		$viewModel->setTerminal(true);
		return $viewModel;

	}


}