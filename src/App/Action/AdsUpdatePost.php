<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 27.11.2017
 * Time: 4:20
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

class AdsUpdatePost implements ServerMiddlewareInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;


    /**
     * @var AdsService
     */
    private $adsService;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * AdsUpdatePost constructor.
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
     * @return RedirectResponse
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $id = $request->getAttribute('id');
        $parsedBody = $request->getParsedBody();

        if ($parsedBody)
            $this->adsService->updateAds($id, $parsedBody);

        return new RedirectResponse($this->router->generateUri('ads.view', ['id' => $id]));
    }
}