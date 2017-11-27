<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 26.11.2017
 * Time: 3:58
 */

namespace App\Action;

use App\Service\AdsService;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;


class AdsAddPost implements ServerMiddlewareInterface
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
     * CarAdd constructor.
     * @param EntityManager $entityManager
     * @param AdsService $adsService
     * @param RouterInterface $router
     */
    public function __construct(
        EntityManager $entityManager,
        AdsService $adsService,
        RouterInterface $router
    )
    {
        $this->entityManager = $entityManager;
        $this->adsService = $adsService;
        $this->router = $router;
    }


    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return ResponseInterface|JsonResponse
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function process(
        ServerRequestInterface $request,
        DelegateInterface $delegate
    )
    {

        $parsedBody = $request->getParsedBody();

        if ($parsedBody)
            $this->adsService->addNewAds($parsedBody);

        // @ToDo Exception

        return new RedirectResponse($this->router->generateUri('index'));

    }


}