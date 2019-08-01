<?php

namespace User\Service;

use Doctrine\ORM\EntityManagerInterface;
use User\Entity\User;
use \Exception;


class LoginService
{
	private $entityManager;

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;

	}

	// public function login($data)
	// {
	// 	$email = $data['email'];
	// 	$password = $data['password'];
	// 	if($this->emailExists($email))
	// 	{
	// 		if($this->passwordMatched($email,$password))
	// 		{
	// 			if($this->userEnabled($email))
	// 			{
	// 				return true;
	// 			}
	// 			throw new Exception("User is disabled");

	// 		}
	// 		throw new Exception("Password Is Incorrect");
	// 	}
	// 	throw new Exception("No such User Found");

	// }

	private function passwordMatched($email,$password) : bool
	{
		$userData = $this->getRepoByEmail($email);
		$hashedPassword = $userData->getPassword();
		if(password_verify($password, $hashedPassword))
			return true;
		return false;
	}

	private function emailExists($email) :bool
	{
		
		if($this->getRepoByEmail($email))
			return true;
		return false;

	}

	private function userEnabled($email)
	{
		$userData = $this->getRepoByEmail($email);
		if($userData->getUserStatus() === User::USER_ENABLED)
		{
			return true;
		}
		throw new Exception("User Is Currently Disabled From the system");
	}

	private function getRepoByEmail($email)
	{
		$userRepo = $this->entityManager->getRepository(User::class);
		$userData = $userRepo->findOneBy(['email' => $email]);
		return $userData;

	}
	
}