<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace App\Action;

use App\Entity\CarBrand;
use App\Entity\CarModel;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class ModelJsonAction implements ServerMiddlewareInterface
{

    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * ModelAddAction constructor.
     * @param TemplateRendererInterface $templateRenderer
     * @param EntityManager $entityManager
     */
    public function __construct(TemplateRendererInterface $templateRenderer, EntityManager $entityManager)
    {
        $this->templateRenderer = $templateRenderer;
        $this->entityManager = $entityManager;
    }


    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return ResponseInterface|HtmlResponse|JsonResponse
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $parsedBody = $request->getParsedBody();

        if ($parsedBody){

            /** @var CarBrand $brand*/
            $brand = $this->entityManager
                ->getRepository(CarBrand::class)
                ->find($parsedBody['brand_id']);

            if ($parsedBody['add_model']){
                $model = new CarModel();
                $brand->getModels()->add($model);
                $model->setName($parsedBody['add_model']);
                $model->setBrand($brand);

                $this->entityManager->persist($model);
                $this->entityManager->flush();

                $data = [];
                foreach ($brand->getModels() as $model){
                    $data['models'][] = [
                        'id' => $model->getId(),
                        'name' => $model->getName()
                    ];
                }
            }

            $data = [];
            foreach ($brand->getModels() as $model){
                $data['models'][] = [
                    'id' => $model->getId(),
                    'name' => $model->getName()
                ];
            }

            return new JsonResponse($data);
        }

        $brands = $this->entityManager
            ->getRepository(CarBrand::class)
            ->findAll();

        return new HtmlResponse($this->templateRenderer->render('app::brand-manager', ['carBrands' => $brands]));
    }
}