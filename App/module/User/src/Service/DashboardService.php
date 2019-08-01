<?php
namespace User\Service;

use User\Entity\User;
use \Exception;

class DashboardService
{
	private $entityManager;

	public function __construct($entityManager)
	{
		$this->entityManager = $entityManager;
	}

	public function changePassword($data,$id)
	{
		$email = $this->entityManager->getRepository(User::class)->find(['user_id' => $id])->getEmail();
		$userRepo = $this->entityManager->getRepository(User::class);
		$user = $userRepo->findOneBy(['email' => $email]);

		if(empty($data['old_password'])&&empty($data['new_password_2'])&&empty($data['new_password_1'])) throw new Exception("Please Enter the data in field as instructed");

			

		
		if(password_verify($data['old_password'], $user->getPassword()))
		{	
			if($data['new_password_1'] == $data['new_password_2'])
			{
				$date = date("Y-m-d H:i:s");
				$user->setPassword(password_hash($data['new_password_2'],PASSWORD_DEFAULT))->setLastPasswordChanged($date);
				$this->entityManager->persist($user);
				$this->entityManager->flush();
				return true;
			}
			throw new Exception("New passwords didnot matched");
		}else

		throw new Exception("Old Password is Incorrect");
	}


}