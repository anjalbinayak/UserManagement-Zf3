<?php
namespace User\Repository;

use Doctrine\ORM\EntityRepository;

use User\Entity\User;



class UserRepository extends EntityRepository
{
	protected $alias = 'shikha';

	public function getUsers($data)
	{

		// $qb=$this->CreateQueryBuilder('r');
		// $qb->where('r.name=roshan');

		// $query=$qb->getQuery()->getResult();
    
        $nameSegment = '';
        $emailSegment = '';
        $addressSegment = '';
        $mobileSegment = '';
        $userTypeSegment = '';
        $userStatusSegment = '';


      


        $name = (isset($data['name'])) ? $data['name'] : '';
        $email = (isset($data['email'])) ? $data['email'] : '';
        $address = (isset($data['address'])) ? $data['address'] : '';
        $mobile = (isset($data['mobile'])) ? $data['mobile'] : '';
        $user_type = (isset($data['user_type'])) ? $data['user_type'] : '';
        $user_status = (isset($data['user_status'])) ? $data['user_status'] : '';

        

     
       $nameSegment = $name ? " AND $this->alias.name LIKE '%{$name}%'" : '';
       $emailSegment = $email ? " AND $this->alias.email LIKE '%{$email}%'" : '';
       $addressSegment = $address ? " AND $this->alias.address LIKE '%{$address}%'" : '';
       $mobileSegment = $mobile ? " AND $this->alias.mobile LIKE '%{$mobile}%'" : '';
       $userTypeSegment = $user_type ? " AND $this->alias.userType = '$user_type'" : '';
       $userStatusSegment = $user_status ? " AND $this->alias.userStatus = '$user_status'":'';

       $entityManager  = $this->getEntityManager();

       $qb = $entityManager->createQueryBuilder($this->alias);
       

       $qb->select($this->alias)
       ->from(User::class,$this->alias)
       ->where("1=1 $nameSegment $emailSegment $addressSegment $mobileSegment $userTypeSegment $userStatusSegment");

       $users = $qb->getQuery()->getResult();
       
       return $users;
       //To be continued


   

	}

}