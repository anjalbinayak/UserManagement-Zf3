<?php
namespace User\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use User\Entity\User;

class UserAuthenticationPlugin extends AbstractPlugin
{
	private $auth;
	private $entityManager;

	public function __construct($auth , $entityManager)
	{
		$this->auth = $auth;
		$this->entityManager = $entityManager;
	}
	
	public function getAuth()
	{
		return $this->auth;

	}

	public function hasIdentity()
	{
		if($this->auth->hasIdentity())
			return true;
		return false;
	}
	public function getIdentity()
	{
		if($this->hasIdentity())
			return $this->auth->getIdentity();
	}

	public function clearAuth()
	{
		$this->auth->clearIdentity();
		return true;

	}

	public function isAdmin()
	{
		$userId = $this->getIdentity();
		$user = $this->entityManager->getRepository(User::class)->find(['user_id' => $userId]);
		if($user->isAdmin())
			return true;
		return false;

	}

	public function getUser()
	{
		$userId = $this->getIdentity();
		$user = $this->entityManager->getRepository(User::class)->find(['user_id' => $userId]);
		if($user)
			return $user;
	}

	public function isPasswordTimedOut()
	{
		$userId = $this->getIdentity();
		$user = $this->entityManager->getRepository(User::class)->find(['user_id' => $userId]);
		if($user->isPasswordTimedOut())
			return true;
		return false;

	}

}