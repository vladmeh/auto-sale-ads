<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Car
 *
 * @ORM\Table(name="car")
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
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
     * @ORM\Column(name="yearIssue", type="integer", length=4)
     */
    private $yearIssue;

    /**
     * @var integer
     *
     * @ORM\Column(name="mileage", type="integer", length=4)
     */
    private $mileage;

    /**
     * @var integer
     *
     * @ORM\Column(name="buildId", type="integer", length=8)
     */
    private $buildId;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var \App\Entity\CarBrand
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\CarBrand", inversedBy="cars")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="brandId", referencedColumnName="id")
     * })
     */
    private $brand;

    /**
     * @var \App\Entity\CarModel
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\CarModel", inversedBy="cars")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="modelId", referencedColumnName="id")
     * })
     */
    private $model;

    /**
     * @var \App\Entity\CarBodyType
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\CarBodyType", inversedBy="cars")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bodyTypeId", referencedColumnName="id")
     * })
     */
    private $bodyType;

    /**
     * @var \App\Entity\CarBuild
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\CarBuild", inversedBy="cars")
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
     * Set yearIssue
     *
     * @param integer $yearIssue
     *
     * @return Car
     */
    public function setYearIssue($yearIssue)
    {
        $this->yearIssue = $yearIssue;

        return $this;
    }

    /**
     * Get yearIssue
     *
     * @return integer
     */
    public function getYearIssue()
    {
        return $this->yearIssue;
    }

    /**
     * Set mileage
     *
     * @param integer $mileage
     *
     * @return Car
     */
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;

        return $this;
    }

    /**
     * Get mileage
     *
     * @return integer
     */
    public function getMileage()
    {
        return $this->mileage;
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
     * @param \App\Entity\CarBrand $brand
     *
     * @return Car
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

    /**
     * Set model
     *
     * @param \App\Entity\CarModel $model
     *
     * @return Car
     */
    public function setModel(\App\Entity\CarModel $model = null)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return \App\Entity\CarModel
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set bodyType
     *
     * @param \App\Entity\CarBodyType $bodyType
     *
     * @return Car
     */
    public function setBodyType(\App\Entity\CarBodyType $bodyType = null)
    {
        $this->bodyType = $bodyType;

        return $this;
    }

    /**
     * Get bodyType
     *
     * @return \App\Entity\CarBodyType
     */
    public function getBodyType()
    {
        return $this->bodyType;
    }

    /**
     * Set build
     *
     * @param \App\Entity\CarBuild $build
     *
     * @return Car
     */
    public function setBuild(\App\Entity\CarBuild $build = null)
    {
        $this->build = $build;

        return $this;
    }

    /**
     * Get build
     *
     * @return \App\Entity\CarBuild
     */
    public function getBuild()
    {
        return $this->build;
    }
}

