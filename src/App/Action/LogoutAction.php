<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 11.02.2018
 * Time: 22:22
 */

namespace App\Action;

use App\Service\AuthAdapter;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Diactoros\Response\RedirectResponse;


class LogoutAction implements ServerMiddlewareInterface
{
    /**
     * @var AuthenticationService
     */
    private $authService;

    /**
     * @var AuthAdapter
     */
    private $authAdapter;

    /**
     * LogoutAction constructor.
     * @param AuthenticationService $authService
     * @param AuthAdapter $authAdapter
     */
    public function __construct(AuthenticationService $authService, AuthAdapter $authAdapter)
    {
        $this->authService = $authService;
        $this->authAdapter = $authAdapter;
    }


    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return RedirectResponse
     * @throws \Exception
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        // Позволяет выйти из учетной записи только авторизованному пользователю.
        if ($this->authService->getIdentity()==null) {
            throw new \Exception('The user is not logged in');
        }

        // Удаляем личность из сессии.
        $this->authService->clearIdentity();

        return new RedirectResponse('/');
    }
}