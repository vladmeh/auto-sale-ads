<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=42, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string")
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=42, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=42, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreate", type="datetime")
     */
    private $dateCreate;

    /**
     * @var string
     *
     * @ORM\Column(name="pwdResetToken", type="string", nullable=true)
     */
    private $pwdResetToken;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pwdResetTokenCreateDate", type="datetime", nullable=true)
     */
    private $pwdResetTokenCreateDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="roleId", type="integer", length=8)
     */
    private $roleId;

    /**
     * @var \App\Entity\Role
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Role", inversedBy="users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="roleId", referencedColumnName="id")
     * })
     */
    private $role;


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
     *
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
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
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
     * Set name
     *
     * @param string $name
     *
     * @return User
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
     * Set phone
     *
     * @param string $phone
     *
     * @return User
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
     * Set address
     *
     * @param string $address
     *
     * @return User
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
     * Set status
     *
     * @param integer $status
     *
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
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     *
     * @return User
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return \DateTime
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * Set pwdResetToken
     *
     * @param string $pwdResetToken
     *
     * @return User
     */
    public function setPwdResetToken($pwdResetToken)
    {
        $this->pwdResetToken = $pwdResetToken;

        return $this;
    }

    /**
     * Get pwdResetToken
     *
     * @return string
     */
    public function getPwdResetToken()
    {
        return $this->pwdResetToken;
    }

    /**
     * Set pwdResetTokenCreateDate
     *
     * @param \DateTime $pwdResetTokenCreateDate
     *
     * @return User
     */
    public function setPwdResetTokenCreateDate($pwdResetTokenCreateDate)
    {
        $this->pwdResetTokenCreateDate = $pwdResetTokenCreateDate;

        return $this;
    }

    /**
     * Get pwdResetTokenCreateDate
     *
     * @return \DateTime
     */
    public function getPwdResetTokenCreateDate()
    {
        return $this->pwdResetTokenCreateDate;
    }

    /**
     * Set roleId
     *
     * @param integer $roleId
     *
     * @return User
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;

        return $this;
    }

    /**
     * Get roleId
     *
     * @return integer
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set role
     *
     * @param \App\Entity\Role $role
     *
     * @return User
     */
    public function setRole(\App\Entity\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \App\Entity\Role
     */
    public function getRole()
    {
        return $this->role;
    }
}

