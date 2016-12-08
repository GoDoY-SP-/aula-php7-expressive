<?php

namespace CodeEmailMKT\Application\Middleware;

use CodeEmailMKT\Domain\Service\AuthenticationServiceInterface;
use CodeEmailMKT\Domain\Service\FlashMessageServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

class AuthenticationMiddleware
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var AuthenticationServiceInterface
     */
    private $authService;


    /**
     * AuthenticationMiddleware constructor.
     * @param RouterInterface                $router
     * @param AuthenticationServiceInterface $authService
     */
    public function __construct(RouterInterface $router, AuthenticationServiceInterface $authService)
    {
        $this->router = $router;
        $this->authService = $authService;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {

        // Validar autenticação
        if (! $this->authService->isAuth()) {

            /** @var FlashMessageServiceInterface $flashMessage */
            $flashMessage = $request->getAttribute('flashMessage');

            // Setar mensagem de sucesso
            $flashMessage->setMessage(FlashMessageServiceInterface::NAMESPACE_ERROR, 'Usuário não autenticado');

            // Não autenticado, redirecionar para login
            $uri = $this->router->generateUri('authentication.login');
            return new RedirectResponse($uri);
        }

        return $next($request, $response);
    }
}
