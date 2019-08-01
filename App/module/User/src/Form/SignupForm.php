<?php

namespace User\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;


class SignupForm extends Form{


	public function __construct()
	{
		parent::__construct("signup-form");
		$this->setAttribute("method","post");
		$this->setAttribute("enctype","multipart/form-data");
		$this->addElement();
		$this->addInputFilter();

	}

	public function addElement()
	{
		$this->add([
			'type' => 'text',
			'name' => 'name',
			'attributes'=>[
				'id' => 'name',
				'class' => 'form-control',
				'placeholder' => 'Enter Your Name',
				
			],
			'options' => [
				'label' => 'Name'
			]
		]);


    	$this->add([
			'type' => 'text',
			'name' => 'email',
			'attributes'=>[
				'id' => 'email',
				'class' => 'form-control',
				'placeholder' => 'Enter Your Email',
				
			],
			'options' => [
				'label' => 'Email'
			]
		]);

		$this->add([
			'type' => 'password',
			'name' => 'password',
			'attributes' => [
				'id' => 'password',
				'class' =>'form-control',
				'placeholder' => 'Enter Your Password'
			],
			'options' => [
				'label' => 'Password'
			]
		]);

		$this->add([
			'type' => 'text',
			'name' => 'address',
			'attributes'=>[
				'id' => 'address',
				'class' => 'form-control',
				'placeholder' => 'Enter Your Address',
				
			],
			'options' => [
				'label' => 'Address'
			]
		]);


		$this->add([
			'type' => 'text',
			'name' => 'mobile',
			'attributes'=>[
				'id' => 'mobile',
				'class' => 'form-control',
				'placeholder' => 'Enter Your Mobile Number',
				
			],
			'options' => [
				'label' => 'Mobile No: '
			]
		]);


		$this->add([
			'type' => 'file',
			'name' => 'image',
			'attributes' => [
				'id' => 'image',
				'class' => 'form-control'
			],
			'options' => [
				'label' => 'Profile Image'
			]
		]);


		$this->add([
			'type' => 'submit',
			'attributes' => [
				'class' => 'btn btn-success',
				'value' => 'save'
			],

		]);




	}

	public function addInputFilter()
	{
		$inputFilter = new InputFilter();
		parent::setInputFilter($inputFilter);

		$inputFilter->add([
			'name' => 'name',
			'required' => true,
			'filters' =>
			[
				['name' => 'stripTags'],
				['name' => 'stringTrim']
			]
		]);

		$inputFilter->add([
			'name' => 'email',
			'required' => true,
			'filters' =>
			[
				['name' => 'stripTags'],
				['name' => 'stringTrim']
			],
			'validators' => [
				['name' => 'EmailAddress']
			]
		]);

		$inputFilter->add([
			'name' => 'address',
			'required' => true,
			'filters' =>[
				['name' => 'stripTags'],
				['name' => 'stringTrim']
			]
		]);

		$inputFilter->add([
			'name' => 'mobile',
			'required' => true,
			'validators' =>
			[
				['name' => 'Digits']
			]
		]);


	}
}