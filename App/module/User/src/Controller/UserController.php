<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Entity\User;
use User\Form\SignupForm;
use \Exception;

class UserController extends AbstractActionController
{
	private $entityManager;
	private $userService;
	


	public function __construct($entityManager , $userService)
	{
		$this->entityManager = $entityManager;
		$this->userService = $userService;
		

	}
	public function indexAction()
	{
		try
		{
			if(!$this->auth()->isAdmin())
		 	{
		 		$this->flashMessenger()->addErrorMessage("You dont Have permission to view that page");
		 		return $this->redirect()->toRoute('dashboard');
		 	}
			
			$data = $this->params()->fromQuery();
			$userRepo = $this->entityManager->getRepository(User::class);
			if($data)
				$allUsers = $userRepo->getUsers($data);
			else
				$allUsers = $userRepo->findAll();

			
		}catch(Exception $e)
		{
			echo $e->getMessage();

		}

		return new viewModel(['allUsers' => $allUsers]);
		
	}

	public function newAction()
	{


	}

	public function viewAction()
	{

	}

	public function disableAction()
	{
		if(!$this->auth()->isAdmin())
	 	{
	 		$this->flashMessenger()->addErrorMessage("You dont Have permission to that action");
	 		return $this->redirect()->toRoute('dashboard');
	 	}
		
		$id = $this->params()->fromRoute('id');
		$userEm = $this->entityManager->getRepository(User::class);
		$user = $userEm->find(['user_id' => $id]);
		if(!$user)
			return $this->redirect()->toRoute('user/index');
		$user->setUserStatus(User::USER_DISABLED);
		$this->entityManager->persist($user);
		$this->entityManager->flush();
		$this->flashMessenger()->addErrorMessage(sprintf("User of Id %d Disabled", $id));
		return $this->redirect()->toRoute('user/index');


		
	}

	public function enableAction()
	{
		if(!$this->auth()->isAdmin())
	 	{
	 		$this->flashMessenger()->addErrorMessage("You dont Have permission to that action");
	 		return $this->redirect()->toRoute('dashboard');
	 	}
		
		$id = $this->params()->fromRoute('id');
		$userEm = $this->entityManager->getRepository(User::class);
		$user = $userEm->find(['user_id' => $id]);
		if(!$user)
			return $this->redirect()->toRoute('user/index');
		$user->setUserStatus(User::USER_ENABLED);
		$this->entityManager->persist($user);
		$this->entityManager->flush();
		$this->flashMessenger()->addSuccessMessage(sprintf("User of Id %d Enabled", $id));
		return $this->redirect()->toRoute('user/index');

	}

	public function editAction()
	{
		try{

			$editForm = new SignupForm();

			if(!$this->auth()->isAdmin())
			{
				$this->flashMessenger()->addErrorMessage('You dont have access to this page');
				return $this->redirect()->toRoute('dashboard');
			}
				$id = $this->params()->fromRoute('id');
				$userEm = $this->entityManager->getRepository(User::class);
				$user = $userEm->find(['user_id' => $id]);
				if(!$user)
					return $this->redirect()->toRoute('user/index');

				if($this->getRequest()->isPost())
				{
					$data = array_merge_recursive(
						$this->params()->fromPost(),
						$this->params()->fromFiles()
					);

					$this->userService->updateUser($id, $data);
					$this->flashMessenger()->addSuccessMessage(sprintf("User details of Id %d updated", $id));
					return $this->redirect()->toRoute('user/index');
					
				}
				
				$data = [
					'name' => $user->getName(),
					'email' => $user->getEmail(),
					'password' => '',
					'address' => $user->getAddress(),
					'mobile' => $user->getMobile()
				];
				$editForm->setData($data);
			

		}catch(Exception $e)
		{
			$this->flashMessenger()->addErrorMessage($e->getMessage());
			return $this->redirect()->toRoute('user/edit', array(
				'controller' => 'User',
				'action' => 'edit',
				'id' => $id
			));

		}
		

		return new ViewModel(['editForm' => $editForm]);
		
	
}

	
}