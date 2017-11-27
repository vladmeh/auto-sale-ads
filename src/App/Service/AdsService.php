<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 26.11.2017
 * Time: 18:16
 */

namespace App\Service;


use App\Entity\Advertisement;
use App\Entity\Car;
use App\Entity\CarBodyType;
use App\Entity\CarBrand;
use App\Entity\CarBuild;
use App\Entity\CarModel;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;

class AdsService
{
    /**
     * Doctrine entity manager.
     * @var EntityManager
     */
    private $entityManager;

    /**
     * AdsService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $data
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addNewAds($data){
        $ads = new Advertisement();
        //$currentDate = date('Y-m-d H:i:s');
        $currentDate = new \DateTime('now');
        $ads->setDateCreate($currentDate);
        $ads->setDateUpdate($currentDate);
        $ads->setPrice($data['ads']['price']);
        if ($data['ads']['content'] && $data['ads']['content'] != '')
            $ads->setContent($data['ads']['content']);
        if ($data['ads']['description'] && $data['ads']['description'] != '')
            $ads->setDescription($data['ads']['description'] && $data['ads']['description'] != '');

        $this->entityManager->persist($ads);

        $car = new Car();
        $car->setBrand(
            $this->entityManager
                ->getRepository(CarBrand::class)
                ->find($data['car']['brand'])
        );
        $car->setModel(
            $this->entityManager
                ->getRepository(CarModel::class)
                ->find($data['car']['model'])
        );
        $car->setBodyType(
            $this->entityManager
                ->getRepository(CarBodyType::class)
                ->find($data['car']['bodyType'])
        );
        $car->setBuild(
            $this->entityManager
                ->getRepository(CarBuild::class)
                ->find($data['car']['build'])
        );
        $car->setYearIssue($data['car']['yearIssue']);
        $car->setMileage($data['car']['mileage']);
        if ($data['car']['description'] && $data['car']['description'] != '')
            $car->setDescription($data['car']['description']);

        $this->entityManager->persist($car);

        $ads->setCar($car);

        $this->entityManager->flush();
    }

    /**
     * @param null $id
     * @param $data
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateAds($id, $data){
        $currentDate = new \DateTime('now');
        /**@var Advertisement $ads*/
        $ads = $this->entityManager
            ->getRepository(Advertisement::class)
            ->find($id);

        /**@var Car $car*/
        $car = $ads->getCar();

        $ads->setDateUpdate($currentDate);
        $ads->setPrice($data['ads']['price']);
        if ($data['ads']['content'] && $data['ads']['content'] != '')
            $ads->setContent($data['ads']['content']);
        if ($data['ads']['description'] && $data['ads']['description'] != '')
            $ads->setDescription($data['ads']['description'] && $data['ads']['description'] != '');

        $this->entityManager->persist($ads);

        $car->setBodyType(
            $this->entityManager
                ->getRepository(CarBodyType::class)
                ->find($data['car']['bodyType'])
        );
        $car->setBuild(
            $this->entityManager
                ->getRepository(CarBuild::class)
                ->find($data['car']['build'])
        );
        $car->setYearIssue($data['car']['yearIssue']);
        $car->setMileage($data['car']['mileage']);
        if ($data['car']['description'] && $data['car']['description'] != '')
            $car->setDescription($data['car']['description']);

        $this->entityManager->persist($car);

        $this->entityManager->flush();
    }

    /**
     * @param $requestQueryParams
     * @return \Doctrine\Common\Collections\Collection
     */
    public function filterAds($requestQueryParams){
        $carCriteria = Criteria::create();

        if($requestQueryParams['brand'] && $requestQueryParams['brand'] != '')
            $carCriteria
                ->where(Criteria::expr()->eq('brandId', $requestQueryParams['brand']));

        if($requestQueryParams['model'] && $requestQueryParams['model'] != '')
            $carCriteria
                ->where(Criteria::expr()->eq('modelId', $requestQueryParams['model']));

        if($requestQueryParams['yearIssue'] && $requestQueryParams['yearIssue'] != '')
            $carCriteria
                ->where(Criteria::expr()->gte('yearIssue', $requestQueryParams['yearIssue']));

        if($requestQueryParams['mileage'] && $requestQueryParams['mileage'] != '')
            $carCriteria
                ->where(Criteria::expr()->lte('mileage', $requestQueryParams['mileage']));

        if($requestQueryParams['build'] && $requestQueryParams['build'] != '')
            $carCriteria
                ->where(Criteria::expr()->eq('buildId', $requestQueryParams['build']));

        $carList = $this->entityManager
            ->getRepository(Car::class)
            ->matching($carCriteria);

        $arrFilter = [];
        foreach ($carList as $car){
            $arrFilter[] = $car->getId();
        }

        $adsCriteria = Criteria::create();
        if (!empty($arrFilter))
            $adsCriteria->where(Criteria::expr()->in('carId', $arrFilter));

        if($requestQueryParams['price'] && $requestQueryParams['price'] != '')
            $adsCriteria
                ->where(Criteria::expr()->lte('price', $requestQueryParams['price']));


        $adsList = $this->entityManager
            ->getRepository(Advertisement::class)
            ->matching($adsCriteria);

        return $adsList;
    }

    /**
     * @param $id
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteAds($id){
        $ads = $this->entityManager->getRepository(Advertisement::class)->find($id);

        if (!$ads)
            throw new \RuntimeException('Такого объявления не существует');

        $this->entityManager->remove($ads);
        $this->entityManager->flush();
    }


}