<?php
namespace User\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use User\Form\LoginForm;
use \Exception;



class LoginController extends AbstractActionController
{
	private $entityManager;
	private $authService;
	private $adapter;
	public function __construct($entityManager , $authService , $adapter)
	{
		$this->entityManager = $entityManager;
		$this->authService = $authService;
		$this->adapter = $adapter;
	}

	public function indexAction()
	{
		if($this->auth()->hasIdentity())
		{
			$this->flashMessenger()->addSuccessMessage("You are already logged In");
			return $this->redirect()->toRoute('dashboard');
		}
		$loginForm = new LoginForm();
		
		
		if($this->getRequest()->isPost())
		{
			$loginErrorMessages = array();
			$data = $this->params()->fromPost();
			$loginForm->setData($data);

			if($loginForm->isValid())
			{
				try
				{
					$data = $loginForm->getData();
					$this->adapter->setEmail($data['email']);
					$this->adapter->setPassword($data['password']);
					$result = $this->authService->authenticate($this->adapter);
					

					if($result->getIdentity())
					{
						if($this->auth()->isPasswordTimedOut())
						{
							$this->flashMessenger()->addErrorMessage("Your Password is not changed since 3 months. Please change it right now");
							return $this->redirect()->toRoute("dashboard/passwordChange");
						}
						$this->flashMessenger()->addSuccessMessage("Logged In Successfully");
						return $this->redirect()->toRoute('dashboard');
					}

					return $this->redirect()->toRoute('login');
				}catch(Exception $e)
				{
					$this->flashMessenger()->addMessage($e->getMessage());
					return $this->redirect()->toRoute("login");
				}
			}
		}

		$viewModel =  new ViewModel([
			'loginForm' => $loginForm
			
		]);
		$viewModel->setTerminal(true);
		return $viewModel;
		
	}

	public function logoutAction()
	{
		$this->auth()->clearAuth();
		$this->flashMessenger()->addSuccessMessage("Logged Out Successfully");
		return $this->redirect()->toRoute('login');

	}

	
}