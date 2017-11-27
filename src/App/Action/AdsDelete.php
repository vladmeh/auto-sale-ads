<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 27.11.2017
 * Time: 5:25
 */

namespace App\Action;


use App\Service\AdsService;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;

use Psr\Http\Message\ServerRequestInterface;

use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Router\RouterInterface;


class AdsDelete implements ServerMiddlewareInterface
{
    /**
     * @var AdsService
     */
    private $adsService;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * AdsDelete constructor.
     * @param AdsService $adsService
     * @param EntityManager $entityManager
     * @param RouterInterface $router
     */
    public function __construct(
        AdsService $adsService,
        EntityManager $entityManager,
        RouterInterface $router
    )
    {
        $this->adsService = $adsService;
        $this->entityManager = $entityManager;
        $this->router = $router;
    }


    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return \Psr\Http\Message\ResponseInterface|RedirectResponse
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        /** @var RouteResult $routeResult */
        $routeResult = $request->getAttribute(RouteResult::class);

        $routeMatchedParams = $routeResult->getMatchedParams();

        if (empty($routeMatchedParams['id']))
            throw new \RuntimeException('Invalid route: "id" not set in matched route params.');

        $this->adsService->deleteAds($routeMatchedParams['id']);

        return new RedirectResponse($this->router->generateUri('index'));
    }
}