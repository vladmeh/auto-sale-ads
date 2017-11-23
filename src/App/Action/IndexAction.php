<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2017, Alpha-Hydro
 *
 */

namespace App\Action;

use App\Entity\CarBodyType;
use App\Entity\CarBrand;
use App\Entity\CarBuild;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class IndexAction implements ServerMiddlewareInterface
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
     * IndexAction constructor.
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
            'carBuilds' => $carBuild
        ];
        return new HtmlResponse($this->templateRenderer->render('app::index-page', $data));
    }
}