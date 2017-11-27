<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 26.11.2017
 * Time: 23:31
 */

namespace App\Action;

use App\Entity\Advertisement;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router\RouteResult;
use Zend\Expressive\Template\TemplateRendererInterface;

class AdsViewAction implements ServerMiddlewareInterface
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
     * AdsViewAction constructor.
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

        return new HtmlResponse($this->templateRenderer->render('app::ads-view', ['ads' => $ads]));
    }
}