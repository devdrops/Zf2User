<?php

namespace Zf2User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Perfil
 *
 * @ORM\Table(name="user_perfil")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Zf2User\Entity\PerfilRepository")
 */
class Perfil
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="cpf_cnpj", type="string", length=255, nullable=true)
     */
    private $cpfCnpj;

    /**
     * @var smallint
     *
     * @ORM\Column(name="person", type="smallint", nullable=false)
     */
    private $person = 1;

    /**
     * @var \Datetime
     *
     * @ORM\Column(name="date_birth", type="datetime", nullable=true)
     */
    private $dateBirth;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="integer", nullable=true)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="complement", type="string", length=255, nullable=true)
     */
    private $complement;

    /**
     * @var string
     *
     * @ORM\Column(name="neighborhood", type="string", length=255, nullable=true)
     */
    private $neighborhood;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=45, nullable=true)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=45, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="cellular", type="string", length=45, nullable=true)
     */
    private $cellular;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="obs", type="string", nullable=true)
     */
    private $obs;

    /**
     * @var \Zf2Base\Entity\Cidade
     *
     * @ORM\ManyToOne(targetEntity="Zf2Base\Entity\Cidade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cidade_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $cidade;

    /**
     * @var \Zf2User\Entity\User
     *
     * @ORM\OneToOne(targetEntity="Zf2User\Entity\User", inversedBy="perfil")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id",onDelete="CASCADE", nullable=false)
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct(array $options = array())
    {
        $hydrator = new Hydrator\ClassMethods();
        $hydrator->hydrate($options, $this);
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
     * Set name
     *
     * @param string $name
     * @return Perfil
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set cpfCnpj
     *
     * @param string $cpfCnpj
     * @return Perfil
     */
    public function setCpfCnpj($cpfCnpj)
    {
        $this->cpfCnpj = $cpfCnpj;

        return $this;
    }

    /**
     * Get cpfCnpj
     *
     * @return string
     */
    public function getCpfCnpj()
    {
        return $this->cpfCnpj;
    }

    /**
     * Set person
     *
     * @param string $person
     * @return Perfil
     */
    public function setPerson($person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return string
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set dateBirth
     *
     * @param string $dateBirth
     * @return Perfil
     */
    public function setDateBirth($dateBirth)
    {
        $this->dateBirth = new \DateTime($dateBirth);

        return $this;
    }

    /**
     * Get dateBirth
     *
     * @return string
     */
    public function getDateBirth()
    {
        return $this->dateBirth;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Perfil
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set number
     *
     * @param string $number
     * @return Perfil
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set complement
     *
     * @param string $complement
     * @return Perfil
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;

        return $this;
    }

    /**
     * Get complement
     *
     * @return string
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Set neighborhood
     *
     * @param string $neighborhood
     * @return Perfil
     */
    public function setNeighborhood($neighborhood)
    {
        $this->neighborhood = $neighborhood;

        return $this;
    }

    /**
     * Get neighborhood
     *
     * @return string
     */
    public function getNeighborhood()
    {
        return $this->neighborhood;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     * @return Perfil
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Perfil
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set cellular
     *
     * @param string $cellular
     * @return Perfil
     */
    public function setCellular($cellular)
    {
        $this->cellular = $cellular;

        return $this;
    }

    /**
     * Get cellular
     *
     * @return string
     */
    public function getCellular()
    {
        return $this->cellular;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Perfil
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set obs
     *
     * @param string $obs
     * @return Perfil
     */
    public function setObs($obs)
    {
        $this->obs = $obs;

        return $this;
    }

    /**
     * Get obs
     *
     * @return string
     */
    public function getObs()
    {
        return $this->obs;
    }

    /**
     * Set cidade
     *
     * @param \Zf2Base\Entity\Cidade $cidade
     * @return Perfil
     */
    public function setCidade(\Zf2Base\Entity\Cidade $cidade = null)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get cidade
     *
     * @return \Zf2Base\Entity\Cidade
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set user
     *
     * @param \Zf2User\Entity\User $user
     * @return Perfil
     */
    public function setUser(\Zf2User\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Zf2User\Entity\User
     */
    public function getUser()
    {
        return $this->user;
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
