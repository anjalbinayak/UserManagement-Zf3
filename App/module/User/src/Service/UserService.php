<?php
namespace User\Service;



use Doctrine\ORM\EntityManagerInterface;
use User\Entity\User;
use \Exception;


class UserService{


    private $entityManager;
    private $signupService;

    public function __construct(EntityManagerInterface $entityManager , $signupService)
    {
        $this->entityManager = $entityManager;
        $this->signupService = $signupService;
    }

    public function updateUser($id, $data)
    {
        
   
        $userRepo = $this->entityManager->getRepository(User::class);
        $user = $userRepo->findOneBy(['user_id' => $id]);


        $image = (empty($data['image']['name'])) ? $user->getImage() : $this->signupService->saveImage($data['image']);

      
        if(empty($data['password']))
        {
            
            $data['password'] = $user->getPassword();
            $data['last_password_canged'] = $user->getLastPasswordChanged();

        }
        else
        {
            $data['password'] = $this->signupService->hashPassword($data['password']);
            $data['last_password_canged'] = date("Y-m-d H:i:s");
        }

        if($this->validateEmailIfDuplicate($user , $data , $id))
            throw new Exception("Email already exists");
        if(empty($data['name']))
            throw new Exception("Name cannot be Empty");
        if(empty($data['address']))
            throw new Exception("Address Field cannot be empty");
        if(empty($data['mobile']))
            throw new Exception("Mobile Number is mandatory");
        if(empty($data['email']))
            throw new Exception("Email is mandatory");

         $user->setName($data['name'])
         ->setAddress($data['address'])
         ->setMobile($data['mobile'])
         ->setEmail($data['email'])
         ->setPassword($data['password'])
         ->setImage($image)
         ->setLastPasswordChanged($data['last_password_canged']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
        
    }

 
    private function validateEmailIfDuplicate($user , $data , $id)
    {
        if($user->getEmail() == $data['email'] && $user->getUserId() == $id)
        {
            return false;
        }
        return true;
    }







}
