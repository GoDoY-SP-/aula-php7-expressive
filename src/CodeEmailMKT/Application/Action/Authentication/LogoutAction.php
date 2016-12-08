<?php

namespace CodeEmailMKT\Application\Action\Authentication;

use CodeEmailMKT\Domain\Service\AuthenticationServiceInterface;
use CodeEmailMKT\Domain\Service\FlashMessageServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

class LogoutAction
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
     * TestePageAction constructor.
     * @param RouterInterface                $router
     * @param AuthenticationServiceInterface $authService
     */
    public function __construct(
        RouterInterface $router,
        AuthenticationServiceInterface $authService = null
    ) {
        $this->router = $router;
        $this->authService = $authService;
    }

    /**
     * Listagem
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     * @return HtmlResponse
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        // FlashMessage
        $flashMessages[FlashMessageServiceInterface::NAMESPACE_SUCCESS] = $request->getAttribute('flashMessage')->getMessage(FlashMessageServiceInterface::NAMESPACE_SUCCESS);
        $flashMessages[FlashMessageServiceInterface::NAMESPACE_ERROR] = $request->getAttribute('flashMessage')->getMessage(FlashMessageServiceInterface::NAMESPACE_ERROR);

        // Logout
        $this->authService->destroy();

        // Redirecionar
        $uri = $this->router->generateUri('authentication.login');
        return new RedirectResponse($uri);
    }
}
