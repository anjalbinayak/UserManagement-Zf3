<?php

namespace User\Entity;
use Doctrine\ORM\Mapping as ORM;
use Interop\Container\ContainerInterface;
use \DateTime;



/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="\User\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User
{

    const FILE_DIR = "public_html/uploads/images/user/";
    const TYPE_ADMIN = "ADMIN";
    const TYPE_USER = "USER";
    const USER_ENABLED = "ENABLED";
    const USER_DISABLED = "DISABLED";



	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(name="user_id")
	 */
    private $user_id;


	/**
	 * @ORM\Column(name="name")
	 */
	private $name;


	/**
	 * @ORM\Column(name="email")
	 */
	private $email;


    /**
     * @ORM\Column(name="password")
     */
    private $password;


	/**
	 * @ORM\Column(name="mobile")
	 */
	private $mobile;


	/**
	 * @ORM\Column(name="address")
	 */
	private $address;


	/**
	 * @ORM\Column(name="image")
	 */
	private $image;


    /**
     * @ORM\Column(name="user_type")
     */
    private $userType;


    /**
     * @ORM\Column(name="user_status")
     */
    private $userStatus;

    /**
     * @ORM\Column(name="last_password_changed")
     */
    private $lastPasswordChanged;


   
    public function getUserId()
    {
        return $this->user_id;
    }

   
    public function getName()
    {
        return $this->name;
    }

   
    public function setName( $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail( $email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;

    }

    
    public function getMobile()
    {
        return $this->mobile;
    }

   
    public function setMobile( $mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    
    public function getAddress()
    {
        return $this->address;
    }

   
    public function setAddress( $address)
    {
        $this->address = $address;

        return $this;
    }

   
    public function getImage()
    {
        return $this->image;
    }

   
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getUserType()
    {
        return $this->userType;
    }

    public function setUserType($userType)
    {
        $this->userType = $userType;

        return $this;
    }

    public function getUserStatus()
    {
        return $this->userStatus;
    }

    public function setUserStatus($userStatus)
    {
        $this->userStatus = $userStatus;
        return $this;
    }

    public function getLastPasswordChanged()
    {
        return $this->lastPasswordChanged;
    }

    public function setLastPasswordChanged($lastPasswordChanged)
    {
        $this->lastPasswordChanged = $lastPasswordChanged;
        return $this;
    }

    public function isAdmin()
    {
        if($this->getUserType() === self::TYPE_ADMIN)
            return true;
        return false;
    }

    public function isPasswordTimedOut()
    {
        $now = new DateTime();
        $then = new DateTime($this->lastPasswordChanged);
        $diff = $now->diff($then);
        if($diff->m > 3)
            return true;
        return false;


    }

    public function lastPasswordChangedDuration()
    {
        $now = new DateTime();
        $then = new DateTime($this->lastPasswordChanged);
        $diff = $now->diff($then);
        if($diff->s > 0)
            $ago = $diff->s."s ago";
        if($diff->i > 0)
            $ago = $diff->i."m ago";
        if($diff->h > 0)
            $ago = $diff->h."h ago";
        if($diff->d > 0)
            $ago = $diff->d."d ago";
        if($diff->m == 1)
            $ago = $diff->m." month ago";
        if($diff->m > 1)
            $ago = $diff->m." months ago";
        return $ago;

    }

 
}