<?php

namespace User\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use \Exception;
use User\Form\SignupForm;
use User\Entity\User;


class DashboardController extends AbstractActionController
{

	private $entityManager;
	private $dashboardService;
	private $userService;

	public function __construct($entityManager , $dashboardService , $userService)
	{
		$this->entityManager = $entityManager;
		$this->dashboardService = $dashboardService;
		$this->userService = $userService;


	}

	public function indexAction()
	{

		if(!$this->auth()->getAuth()->hasIdentity())
		{
			return $this->redirect()->toRoute('login');

		}
		$userId = $this->auth()->getAuth()->getIdentity();
		$user = $this->entityManager->getRepository(User::class)->find(['user_id' => $userId]);

		return new ViewModel(['user' => $user]);

	}

	public function profileAction()
	{
		if(!$this->auth()->getAuth()->hasIdentity())
		{
			return $this->redirect()->toRoute('login');

		}
		if($this->auth()->isPasswordTimedOut())
		{
			$this->flashMessenger()->addErrorMessage("Your Password is not changed since 3 months . Change it soon");
			return $this->redirect()->toRoute("dashboard/passwordChange");
		}
		

		$userId = $this->auth()->getAuth()->getIdentity();
		$user = $this->entityManager->getRepository(User::Class)->find(['user_id' => $userId]);


			

		return new ViewModel(['user' => $user]);
	}

	public function passwordChangeAction()
	{
		if(!$this->auth()->getAuth()->hasIdentity())
		{
			return $this->redirect()->toRoute('login');

		}

		try
		{
			$user = $this->auth()->getAuth()->getIdentity();
			if($this->getRequest()->isPost())
			{
				$data = $this->params()->fromPost();
				if($this->dashboardService->changePassword($data,$user))
				{
					$this->flashMessenger()->addSuccessMessage('Password Changed Successfully');
					$this->redirect()->toRoute('dashboard');
				}

				
			
			}

		}catch(Exception $e)
		{
			$this->flashMessenger()->addErrorMessage($e->getMessage());
			return $this->redirect()->toRoute('dashboard/passwordChange');
			
		}


	
	}

	public function editAction()
	{
		try{

			$editForm = new SignupForm();
            if(!$this->auth()->getAuth()->hasIdentity())
            {
            	return $this->redirect()->toRoute('login');

            }
            	$userId = $this->auth()->getAuth()->getIdentity();
				$user = $this->entityManager->getRepository(User::class)->find(['user_id' => $userId]);
				

				if($this->getRequest()->isPost())
				{
					$data = array_merge_recursive(
						$this->params()->fromPost(),
						$this->params()->fromFiles()
					);


					$this->userService->updateUser($userId, $data);
					$this->flashMessenger()->addSuccessMessage("Profile Updated Successfully");
					return $this->redirect()->toRoute('dashboard/profile');
					

				}
				
				$data = [
					'name' => $user->getName(),
					'email' => $user->getEmail(),
					'address' => $user->getAddress(),
					'mobile' => $user->getMobile()
				];
				$editForm->remove('password');
				$editForm->setData($data);
			

		}catch(Exception $e)
		{
			$this->flashMessenger()->addErrorMessage($e->getMessage());
			return $this->redirect()->toRoute('dashboard/profile/edit');

		}

		

		return new ViewModel(['editForm' => $editForm]);
		
	}

}