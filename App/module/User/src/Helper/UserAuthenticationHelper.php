<?php
namespace User\Helper;

use Zend\View\Helper\AbstractHelper;

class UserAuthenticationHelper extends AbstractHelper
{

	private $authControllerPlugin;
	private $entityManager;

	public function __construct($authControllerPlugin , $entityManager)
	{
		$this->authControllerPlugin = $authControllerPlugin;
		$this->entityManager = $entityManager;	
	}

	public function getCurrentUser()
	{
		return $this->authControllerPlugin->getUser();
	}


}