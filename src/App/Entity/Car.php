<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Car
 *
 * @ORM\Table(name="car")
 * @ORM\Entity
 */
class Car
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
     * @var integer
     *
     * @ORM\Column(name="brandId", type="integer", length=8)
     */
    private $brandId;

    /**
     * @var integer
     *
     * @ORM\Column(name="modelId", type="integer")
     */
    private $modelId;

    /**
     * @var integer
     *
     * @ORM\Column(name="bodyTypeId", type="integer")
     */
    private $bodyTypeId;

    /**
     * @var integer
     *
     * @ORM\Column(name="year", type="integer", length=4)
     */
    private $year;

    /**
     * @var integer
     *
     * @ORM\Column(name="mileageId", type="integer", length=4)
     */
    private $mileageId;

    /**
     * @var integer
     *
     * @ORM\Column(name="buildId", type="integer", length=4)
     */
    private $buildId;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var CarBrand
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\CarBrand")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="brandId", referencedColumnName="id")
     * })
     */
    private $brand;

    /**
     * @var CarModel
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\CarModel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="modelId", referencedColumnName="id")
     * })
     */
    private $model;

    /**
     * @var CarBodyType
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\CarBodyType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bodyTypeId", referencedColumnName="id")
     * })
     */
    private $bodyType;

    /**
     * @var CarMileage
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\CarMileage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mileageId", referencedColumnName="id")
     * })
     */
    private $mileage;

    /**
     * @var CarBuild
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\CarBuild")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="buildId", referencedColumnName="id")
     * })
     */
    private $build;


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
     * Set brandId
     *
     * @param integer $brandId
     *
     * @return Car
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
     * Set modelId
     *
     * @param integer $modelId
     *
     * @return Car
     */
    public function setModelId($modelId)
    {
        $this->modelId = $modelId;

        return $this;
    }

    /**
     * Get modelId
     *
     * @return integer
     */
    public function getModelId()
    {
        return $this->modelId;
    }

    /**
     * Set bodyTypeId
     *
     * @param integer $bodyTypeId
     *
     * @return Car
     */
    public function setBodyTypeId($bodyTypeId)
    {
        $this->bodyTypeId = $bodyTypeId;

        return $this;
    }

    /**
     * Get bodyTypeId
     *
     * @return integer
     */
    public function getBodyTypeId()
    {
        return $this->bodyTypeId;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return Car
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set mileageId
     *
     * @param integer $mileageId
     *
     * @return Car
     */
    public function setMileageId($mileageId)
    {
        $this->mileageId = $mileageId;

        return $this;
    }

    /**
     * Get mileageId
     *
     * @return integer
     */
    public function getMileageId()
    {
        return $this->mileageId;
    }

    /**
     * Set buildId
     *
     * @param integer $buildId
     *
     * @return Car
     */
    public function setBuildId($buildId)
    {
        $this->buildId = $buildId;

        return $this;
    }

    /**
     * Get buildId
     *
     * @return integer
     */
    public function getBuildId()
    {
        return $this->buildId;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Car
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set brand
     *
     * @param CarBrand $brand
     *
     * @return Car
     */
    public function setBrand(CarBrand $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return CarBrand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set model
     *
     * @param CarModel $model
     *
     * @return Car
     */
    public function setModel(CarModel $model = null)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return CarModel
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set bodyType
     *
     * @param CarBodyType $bodyType
     *
     * @return Car
     */
    public function setBodyType(CarBodyType $bodyType = null)
    {
        $this->bodyType = $bodyType;

        return $this;
    }

    /**
     * Get bodyType
     *
     * @return CarBodyType
     */
    public function getBodyType()
    {
        return $this->bodyType;
    }

    /**
     * Set mileage
     *
     * @param CarMileage $mileage
     *
     * @return Car
     */
    public function setMileage(CarMileage $mileage = null)
    {
        $this->mileage = $mileage;

        return $this;
    }

    /**
     * Get mileage
     *
     * @return CarMileage
     */
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * Set build
     *
     * @param CarBuild $build
     *
     * @return Car
     */
    public function setBuild(CarBuild $build = null)
    {
        $this->build = $build;

        return $this;
    }

    /**
     * Get build
     *
     * @return CarBuild
     */
    public function getBuild()
    {
        return $this->build;
    }
}

