<?php

namespace Zf2User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;
use Zend\Math\Rand,
    Zend\Crypt\Key\Derivation\Pbkdf2;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Zf2User\Entity\UserRepository")
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=45, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="password_clue", type="string", length=45, nullable=true)
     */
    private $passwordClue;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="activation_key", type="string", length=255, nullable=false)
     */
    private $activationKey;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_login", type="datetime", nullable=false)
     */
    private $lastLogin;

    /**
     * @var \Zf2Acl\Entity\Role
     *
     * @ORM\ManyToOne(targetEntity="Zf2Acl\Entity\Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $role;

    /**
     * @var \DftBusiness\Entity\Business
     *
     * @ORM\ManyToOne(targetEntity="DftBusiness\Entity\Business")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="businesss_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $business;

    /**
     * @var \Zf2User\Entity\Perfil
     *
     * @ORM\OneToOne(targetEntity="Zf2User\Entity\Perfil", mappedBy="user", cascade={"persist"})
     */
    private $perfil;

    /**
     * Constructor
     */
    public function __construct(array $options = array())
    {
        $hydrator = new Hydrator\ClassMethods();
        $hydrator->hydrate($options, $this);

        $this->created = new \DateTime("now");
        $this->lastLogin = new \DateTime("now");

        $this->salt = base64_encode(Rand::getBytes(8, true));
        $this->activationKey = md5($this->email.$this->salt);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $this->encryptPassword($password);

        return $this;
    }

    public function encryptPassword($password)
    {
        return base64_encode(Pbkdf2::calc('sha256', $password, $this->salt, 10000, strlen($password*2)));
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set passwordClue
     *
     * @param string $passwordClue
     * @return User
     */
    public function setPasswordClue($passwordClue)
    {
        $this->passwordClue = $passwordClue;

        return $this;
    }

    /**
     * Get passwordClue
     *
     * @return string
     */
    public function getPasswordClue()
    {
        return $this->passwordClue;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set activationKey
     *
     * @param string $activationKey
     * @return User
     */
    public function setActivationKey($activationKey)
    {
        $this->activationKey = $activationKey;

        return $this;
    }

    /**
     * Get activationKey
     *
     * @return string
     */
    public function getActivationKey()
    {
        return $this->activationKey;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return User
     */
    public function setCreated()
    {
        $this->created = new \DateTime("now");

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set lastLogin
     *
     * @ORM\PrePersist
     * @param \DateTime $lastLogin
     * @return User
     */
    public function setLastLogin()
    {
        $this->lastLogin = new \DateTime("now");

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set role
     *
     * @param \Zf2Acl\Entity\Role $role
     * @return User
     */
    public function setRole(\Zf2Acl\Entity\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \Zf2Acl\Entity\Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set business
     *
     * @param \DftBusiness\Entity\Business $business
     * @return User
     */
    public function setBusiness(\DftBusiness\Entity\Business $business = null)
    {
        $this->business = $business;

        return $this;
    }

    /**
     * Get business
     *
     * @return \DftBusiness\Entity\Business
     */
    public function getBusiness()
    {
        return $this->business;
    }

    /**
     * Get perfil
     *
     * @return \Zf2User\Entity\Perfil
     */
    public function getPerfil()
    {
        return $this->perfil;
    }

    /**
     * Set perfil
     *
     * @param \Zf2User\Entity\Perfil $perfil
     * @return User
     */
    public function setPerfil(\Zf2User\Entity\Perfil $perfil = null)
    {
        $this->perfil = $perfil;

        return $this;
    }

    /*
     * toArray
     */
    public function toArray()
    {
        $hydrator = new Hydrator\ClassMethods();
        return $hydrator->extract($this);
    }
}
