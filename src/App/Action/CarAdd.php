<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 26.11.2017
 * Time: 3:58
 */

namespace App\Action;

use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class CarAdd implements ServerMiddlewareInterface
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * CarAdd constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $parsedBody = $request->getParsedBody();

        return new JsonResponse($parsedBody['car']);
    }
}