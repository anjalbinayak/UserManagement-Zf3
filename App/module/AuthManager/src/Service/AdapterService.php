<?php
namespace AuthManager\Service;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use User\Entity\User;
use \Exception;

class AdapterService Implements AdapterInterface
{
	private $email;
	private $password;
	private $entityManager;
	private $userRepo;

	public function __construct($entityManager)
	{
		$this->entityManager = $entityManager;
		$this->userRepo = $this->entityManager->getRepository(User::class);
	}

	public function setEmail($email)
	{
		$this->email = $email;
		return $this;
	}

	public function setPassword($password)
	{
		$this->password = $password;
		return $this;
	}

	public function authenticate()
	{
		$user  = $this->userRepo->findOneByEmail($this->email);
		if(!$user)
			throw new Exception("User With Such Email Not found");

		if($user->getUserStatus() == User::USER_DISABLED)
			throw new Exception("This account is currently disabled from our System");

		if(password_verify($this->password, $user->getPassword()))
			return new Result(Result::SUCCESS , $user->getUserId() , [' Authenticated Successfully ']);

		throw new Exception("Invalid Credentials");

	}
}