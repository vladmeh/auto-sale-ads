<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CarModel
 *
 * @ORM\Table(name="car_model")
 * @ORM\Entity(repositoryClass="App\Repository\CarModelRepository")
 */
class CarModel
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
     * @ORM\Column(name="name", type="string", length=42)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="brandId", type="integer")
     */
    private $brandId;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Car", mappedBy="model")
     */
    private $cars;

    /**
     * @var \App\Entity\CarBrand
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\CarBrand", inversedBy="models")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="brandId", referencedColumnName="id")
     * })
     */
    private $brand;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cars = new \Doctrine\Common\Collections\ArrayCollection();
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
     *
     * @return CarModel
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
     * Set brandId
     *
     * @param integer $brandId
     *
     * @return CarModel
     */
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;

        return $this;
    }

    /**
     * Get brandId
     *
     * @return integer
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * Add car
     *
     * @param \App\Entity\Car $car
     *
     * @return CarModel
     */
    public function addCar(\App\Entity\Car $car)
    {
        $this->cars[] = $car;

        return $this;
    }

    /**
     * Remove car
     *
     * @param \App\Entity\Car $car
     */
    public function removeCar(\App\Entity\Car $car)
    {
        $this->cars->removeElement($car);
    }

    /**
     * Get cars
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCars()
    {
        return $this->cars;
    }

    /**
     * Set brand
     *
     * @param \App\Entity\CarBrand $brand
     *
     * @return CarModel
     */
    public function setBrand(\App\Entity\CarBrand $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \App\Entity\CarBrand
     */
    public function getBrand()
    {
        return $this->brand;
    }
}

