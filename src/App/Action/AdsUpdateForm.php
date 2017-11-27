<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 27.11.2017
 * Time: 2:55
 */

namespace App\Action;

use App\Entity\Advertisement;
use App\Entity\CarBodyType;
use App\Entity\CarBrand;
use App\Entity\CarBuild;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Template\TemplateRendererInterface;

class AdsUpdateForm implements ServerMiddlewareInterface
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
     * AdsUpdateForm constructor.
     * @param TemplateRendererInterface $templateRenderer
     * @param EntityManager $entityManager
     */
    public function __construct(TemplateRendererInterface $templateRenderer, EntityManager $entityManager)
    {
        $this->templateRenderer = $templateRenderer;
        $this->entityManager = $entityManager;
    }


    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {

        /** @var RouteResult $routeResult */
        $routeResult = $request->getAttribute(RouteResult::class);

        $routeMatchedParams = $routeResult->getMatchedParams();

        if (empty($routeMatchedParams['id']))
            throw new \RuntimeException('Invalid route: "full_path" not set in matched route params.');

        $ads = $this->entityManager->getRepository(Advertisement::class)
            ->find($routeMatchedParams['id']);

        if (!$ads)
            return new HtmlResponse($this->templateRenderer->render('error::404'), 404);

        if ($request->getParsedBody())
            return $delegate->process($request);

        $carBrands = $this->entityManager
            ->getRepository(CarBrand::class)
            ->findAll();

        $carBodyType = $this->entityManager
            ->getRepository(CarBodyType::class)
            ->findAll();

        $carBuild = $this->entityManager
            ->getRepository(CarBuild::class)
            ->findAll();

        $data = [
            'carBrands' => $carBrands,
            'carBodyTypes' => $carBodyType,
            'carBuilds' => $carBuild,
            'ads' => $ads,
        ];

        return new HtmlResponse($this->templateRenderer->render('app::ads-update-form', $data));
    }
}