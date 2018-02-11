<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 11.02.2018
 * Time: 1:44
 */

namespace App\Action;

use App\Entity\User;
use App\Service\UserManager;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\RedirectResponse;

class UserAddPost implements ServerMiddlewareInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var UserManager
     */
    private $userManager;

    /**
     * UserAddPost constructor.
     * @param EntityManager $entityManager
     * @param UserManager $userManager
     */
    public function __construct(EntityManager $entityManager, UserManager $userManager)
    {
        $this->entityManager = $entityManager;
        $this->userManager = $userManager;
    }


    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return JsonResponse|RedirectResponse
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $parsedBody = $request->getParsedBody();

        if ($parsedBody)
            $this->userManager->addUser($parsedBody);
        else
            $this->userManager->createAdminUserIfNotExists();

        $users = $this->entityManager->getRepository(User::class)
            ->findAll();


        return new RedirectResponse($request->getHeaderLine('referer'));
        //return new JsonResponse($users);
    }
}