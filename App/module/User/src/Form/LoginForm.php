<?php
namespace User\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class LoginForm extends Form{

	public function __construct()
	{
		parent::__construct("login-form");
		$this->setAttribute("method","POST");
		$this->addElement();
		$this->addInputFilter();
	}

	public function addElement()
	{

		$this->add([
			'type' => 'text',
			'name' => 'email',
			'attributes' => 
			[
				'id' => 'email',
				'class' => 'form-control',
				'placeholder' => 'Enter Email'
			],
			'options' => 
			[
				'label' => 'Email'
			]

		]);

		$this->add([
			'type' => 'password',
			'name' => 'password',
			'attributes' => [
				'id' => 'password',
				'class' => 'form-control form-control-sm',
				'placeholder' => 'Enter Your Password'
			],
			'options' => [
				'label' => 'Password'
			]
		]);

		$this->add([
			'type' => 'submit',
			'name' => 'login',
			'attributes' => [
				'value' => 'login',
				'class' => 'btn btn-primary'
			]
		]);

	}

	public function addInputFilter()
	{
		$inputFilter = new InputFilter();
		parent::setInputFilter($inputFilter);

		$inputFilter->add([
			'name' => 'email',
			'required' => true,
			'filters' =>[
				['name' => 'stringTrim'],
				['name' => 'stripTags']
			]
		]);

		$inputFilter->add([
			'name' => 'password',
			'required' => true,
			'filters' => [
				['name' => 'stringTrim'],
				['name' => 'stripTags']
			]
			]);

	}
}