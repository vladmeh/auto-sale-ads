<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CarModel
 *
 * @ORM\Table(name="car_model")
 * @ORM\Entity
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Car", mappedBy="modelId")
     */
    private $cars;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cars = new ArrayCollection();
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
     * Add car
     *
     * @param Car $car
     *
     * @return CarModel
     */
    public function addCar(Car $car)
    {
        $this->cars[] = $car;

        return $this;
    }

    /**
     * Remove car
     *
     * @param Car $car
     */
    public function removeCar(Car $car)
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
}

