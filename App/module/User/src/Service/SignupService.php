<?php
namespace User\Service;



use Doctrine\ORM\EntityManagerInterface;
use User\Entity\User;
use User\Entity\DefaultConfiguration;
use \Exception;


class SignupService {


    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function setData($data)
    {
        if($this->emailExists($data['email']))
            throw new Exception("Email already Exists");

        foreach ($data as $key => $value) {
            if(empty($data[$key]))
            {
                $message = $key." is empty";
                throw new Exception($message);
            }
        }
        if(strlen($data['password']) < 6)
            throw new Exception("Password cannot be less than 6 letters");

        $date = date("Y-m-d H:i:s");
    	$image = $this->saveImage($data['image']);
        $password  = $this->hashPassword($data['password']);
    	$user = new User();
    	$user->setName($data['name'])->setEmail($data['email'])->setPassword($password)->setAddress($data['address'])->setMobile($data['mobile'])->setImage($image)->setUserType($this->getDefaultUserType())->setUserStatus($this->getDefaultUserStatus())->setLastPasswordChanged($date);
    	$this->entityManager->persist($user);
    	$this->entityManager->flush();
        
    }

     public function saveImage(array $image){
        $fileDir = User::FILE_DIR;
        
        if(!is_dir($fileDir)){
            mkdir($fileDir, 0777, true);
        }
        $imageFileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $fileName = "user".date("YmdHis").uniqid().".".$imageFileType;
        $fullFilePath = $fileDir.$fileName;
        move_uploaded_file($image['tmp_name'], $fullFilePath);
        return $fileName;

    }

    public function getDefaultUserType()
    {
        $userRepo = $this->entityManager->getRepository(DefaultConfiguration::class);
        $userDefault = $userRepo->findOneBy(['optionName' => 'default_user']);
       
        return $userDefault->getOptionValue();
    }

    public function getDefaultUserStatus()
    {
        $userRepo = $this->entityManager->getRepository(DefaultConfiguration::class);
        $userDefault = $userRepo->findOneBy(['optionName' => 'default_user_status']);
       
        return $userDefault->getOptionValue();

    }

    public function hashPassword($password)
    {
        return  password_hash($password, PASSWORD_DEFAULT);
    }

  
    public function emailExists($email) :bool
    {
        
        if($this->getRepoByEmail($email))
            return true;
        return false;

    }

    private function getRepoByEmail($email)
    {
        $userRepo = $this->entityManager->getRepository(User::class);
        $userData = $userRepo->findOneBy(['email' => $email]);
        return $userData;

    }



}


